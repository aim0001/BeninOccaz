<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define Gates for user types
        Gate::define('isSeller', function ($user) {
            return in_array($user->role, ['seller', 'admin']);
        });

        Gate::define('isBuyer', function ($user) {
            return in_array($user->role, ['buyer', 'admin']);
        });

        Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });
    }
}
