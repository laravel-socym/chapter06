<?php
declare(strict_types=1);

namespace App\Providers;

use App\Gate\UserAccess;
use App\Policies\ContentPolicy;
use App\Auth\UserTokenProvider;
use App\Auth\CacheUserProvider;
use App\DataProvider\Database\UserToken;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

use function intval;
use Psr\Log\LoggerInterface;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \stdClass::class => ContentPolicy::class,
    ];

    /**
     * @param GateContract    $gate
     * @param LoggerInterface $logger
     */
    public function boot(GateContract $gate, LoggerInterface $logger)
    {
        $this->registerPolicies();
        $gate->define('user-access', new UserAccess());
        //
        $gate->before(function (Authenticatable $user, $ability) use ($logger) {
            $logger->info($ability, [
                    'user_id' => $user->getAuthIdentifier()
                ]
            );
        });

        /*
         * リスト6.5.2.1：ログインしているユーザーのみアクセスを許可する認可処理例
        $gate->define('user-access', function (User $user, $id) {
            return intval($user->getAuthIdentifier()) === intval($id);
        });
         */
        $this->app['auth']->provider(
            'cache_eloquent',
            function (Application $app, array $config) {
                // $config['model']を変更可能にする場合は、config/auth.phpで指定します。
                // 変更しない場合は、固定値として \App\User::class などを記述します
                return new CacheUserProvider(
                    $app['hash'],
                    $config['model'],
                    $app['cache']->driver()
                );
            });

        $this->app['auth']->provider(
            'user_token',
            function (Application $app) {
                return new UserTokenProvider(new UserToken($app['db']));
            });
    }
}
