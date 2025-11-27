<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::define('isSuperAdmin', function (User $user) {

            return $user->roles()->first()->slug == 'super-admin' ;

        });
        Gate::define('isAdmin', function (User $user) {

            return $user->roles->first()->slug == 'admin' ;
        });
        Gate::define('isEditor', function (User $user) {

            return $user->roles->first()->slug == 'editor' ;
        });
        Gate::define('isAccountent', function (User $user) {

            return $user->roles->first()->slug == 'accountent' ;
        });
        Gate::define('isReporter', function (User $user) {

            return $user->roles->first()->slug == 'reporter' ;
        });

        Passport::routes();
//        Passport::tokensExpireIn(now()->addDays(30));
//        Passport::refreshTokensExpireIn(now()->addDays(30));
//        Passport::personalAccessTokensExpireIn(now()->addDays(30));
        Passport::enableImplicitGrant();
    }
}
