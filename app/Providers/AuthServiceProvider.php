<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\User;
use App\Event;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Event' => 'App\Policies\EventPolicy',
    ];

    /*
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user, $permission){
            if($user->roles->map->name->contains('admin')) { // Admin
                return true;
            }
        });

        Gate::after(function (User $user, $permission){
            //Handle user ownership permissions before roles (e.g Author permissions)
            return $user->permissions()->contains($permission);
        });
    }
}
