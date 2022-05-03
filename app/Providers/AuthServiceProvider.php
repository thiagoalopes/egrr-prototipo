<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Administrativo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::define('isAdminCurso', function(User $user){

            $administrativo = Administrativo::where('cpf', $user->cpf)->first();
            if($administrativo != null && $administrativo->f_cursos == '1')
            {
                return true;
            }
            return false;

        });

        Gate::define('isMaster', function(User $user){

            $administrativo = Administrativo::where('cpf', $user->cpf)->first();
            if($administrativo != null && $administrativo->f_master == '1')
            {
                return true;
            }
            return false;

        });
    }
}
