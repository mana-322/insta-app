<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
// gate - determines if a user is authorized/allowed to perform a given action
// for example: edit and delete
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::useBootstrap();

        Gate::define('admin', function($user){
            // $user is an instance of the User model
            return $user->role_id === User::ADMIN_ROLE_ID;
        });
    }
}
