<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Access\Gate;

final class RetrieveAction extends Controller
{
    private $authManager;
    private $gate;

    public function __construct(AuthManager $authManager, Gate $gate)
    {
        $this->authManager = $authManager;
        $this->gate = $gate;
    }

    public function __invoke(string $id)
    {
        $class = new \stdClass();
        $class->id = 1;
        // ①
        $this->gate->forUser(
            $this->authManager->guard()->user()
        )->allows('edit', $class);

        /*
         * リスト6.5.2.14：AuthorizesRequestsトレイトのメソッド利用
        $this->authorizeForUser(
            $this->authManager->guard()->user(),
            'edit',
            $class
        );
        */
    }
}
