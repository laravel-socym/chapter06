<?php
declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Contracts\Factory;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class RegisterAction
 */
final class RegisterAction extends Controller
{
    /**
     * @param Factory $factory
     *
     * @return RedirectResponse
     */
    public function __invoke(Factory $factory): RedirectResponse
    {
        return $factory->driver('amazon')->redirect();
    }
}
