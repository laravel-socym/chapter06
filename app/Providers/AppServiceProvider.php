<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;
use App\Foundation\ViewComposer\PolicyComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @param Factory $factory
     */
    public function boot(Factory $factory): void
    {
        $factory->composer('hello', PolicyComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
