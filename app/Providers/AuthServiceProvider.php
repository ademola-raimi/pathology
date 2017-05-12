<?php

namespace App\Providers;

use App\User;
use App\Patient;
use App\Report;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // lab user can view
        $gate->define('lab-user', function ($user) {
            return $user->role_id === 2;
        });

        // Operator user can view
        $gate->define('operator-user', function ($user) {
            return $user->role_id === 3;
        });
    }
}
