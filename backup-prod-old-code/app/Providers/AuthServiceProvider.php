<?php

namespace App\Providers;

use App\Helpers\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user) {
            $permissions = \Modules\AdminAuth\Entities\Permissions::getAllPermissions();
            $permissionsUser = Auth::get_permissions($user);
            foreach ($permissions as $key => $permission) {
                if(Auth::is_admin($user)){
                    $is = true;
                }else{
                    $route = $permission['route'];
                    $is = array_key_exists($route, $permissionsUser);
                }
                Gate::define($permission['route'], function () use ($is) {
                    return $is;
                });
            }
        });

    }
}
