<?php

namespace Fanintek\Fantasena\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'FanintekFantasena\Model' => 'FanintekFantasena\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Retrieve FanRBAC Configuration
        $super_admin = config('fanrbac.super_admin');

        // Check if Super Admin is assigned
        if (!empty($super_admin)) {
            Gate::before(function ($user, $ability) use ($super_admin) {
                return $user->hasRole($super_admin) ? true : null;
            });
        }
    }
}
