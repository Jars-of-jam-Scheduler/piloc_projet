<?php

namespace App\Providers;

use App\Models\{User, Residence};

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
		
		Gate::define('is-admin', function(User $user) {
			return $user->hasRole('admin');
		});

		Gate::define('is-landlord', function(User $user) {
			return $user->hasRole('landlord');
		});

		Gate::define('is-admin-or-landlord', function(User $user) {
			return $user->hasRole('admin') || $user->hasRole('landlord');
		});

		Gate::define('get-one-residence', function(User $user, Residence $residence) {
			return $user->hasRole('admin') || ($user->hasRole('landlord') && in_array($user->getKey(), $residence->landlords()->pluck('landlord_id')));
		});

		Gate::define('update-residence', function(User $user, Residence $residence) {
			return $user->hasRole('admin') || ($user->hasRole('landlord') && in_array($user->getKey(), $residence->landlords()->pluck('landlord_id')));
		});

		Gate::define('destroy-residence', function(User $user, Residence $residence) {
			return $user->hasRole('admin') || ($user->hasRole('landlord') && in_array($user->getKey(), $residence->landlords()->pluck('landlord_id')));
		});

        Passport::tokensExpireIn(now()->addSeconds(10));
		Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
