<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // set default max length for DB:Schema
        Schema::defaultStringLength(191);

        Validator::extend('alpha_space', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        Validator::extend('password', function ($attribute, $value, $parameters, $validator) {
            // Contain at least one uppercase/lowercase letters, one number and one special char
            return preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*(_|[^\w])).+$/', (string)$value);
        }, 'The :attribute Contain at least one letter, one number and one special char.');
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
