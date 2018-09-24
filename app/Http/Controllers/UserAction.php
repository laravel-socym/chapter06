<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserAction
 */
class UserAction extends Controller
{
    private $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function __invoke(Request $request)
    {
        /** @var \App\Entity\User $user */
        $user = $this->authManager->guard('api')->user();

        return new JsonResponse([
            'id'   => $user->getAuthIdentifier(),
            'name' => $user->getName()
        ]);
    }
}
