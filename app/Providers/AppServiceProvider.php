<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Account;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('request', function($request) {
            $token = $request->input('auth_token');

            if (!$token) {
                $token = $request->cookie('auth_token');
            }

            return Account::whereToken($token)->first();
        });
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
