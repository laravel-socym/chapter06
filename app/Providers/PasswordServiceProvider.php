<?php
declare(strict_types=1);

namespace App\Providers;

use App\Auth\Passwords\PasswordManager;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;

class PasswordServiceProvider extends PasswordResetServiceProvider
{
    protected function registerPasswordBroker()
    {
        $this->app->singleton('auth.password', function ($app) {
            return new PasswordManager($app);
        });

        $this->app->bind('auth.password.broker', function ($app) {
            return $app->make('auth.password')->broker();
        });
    }
}
