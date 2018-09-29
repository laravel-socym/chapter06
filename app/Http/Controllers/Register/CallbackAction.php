<?php
declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Auth\AuthManager;
use Laravel\Socialite\Contracts\Factory;
use Laravel\Socialite\Two\GithubProvider;
use Psr\Log\LoggerInterface;

use function redirect;

final class CallbackAction extends Controller
{
    public function __invoke(
        Factory $factory,
        AuthManager $authManager,
        LoggerInterface $log
    ) {
        /** @var GithubProvider $driver */
        $driver = $factory->driver('amazon');
        $user = $driver->setHttpClient(
            new Client([
                'handler' => tap(
                    HandlerStack::create(),
                    function (HandlerStack $stack) use ($log) {
                        $stack->push(Middleware::log($log, new MessageFormatter()));
                    })
            ])
        )->user();
        $authManager->guard()->login(
            User::firstOrCreate([
                'name'  => $user->getName(),
                'email' => $user->getEmail(),
            ]),
            true
        );
        return redirect('/home');
    }
}
