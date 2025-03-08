<?php

namespace App\Providers;

use App\Policies\BookPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Modules\V1\Entities\Book;
use Modules\V1\Entities\User;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Book::class => BookPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit_books', function ($user, $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('create_users', function (User $user) {
            return $user->is_Admin
                ? Response::allow()
                : Response::deny('You must be an administrator.');
        });

        Gate::define('create_books', function (User $user) {
            return $user->is_Admin
                ? Response::allow()
                : Response::deny('You must be an administrator.');
        });

        Gate::define('get_users', function (User $user) {
            return $user->is_Admin
                ? Response::allow()
                : Response::deny('You must be an administrator.');
        });
        //check Before 
        Gate::before(function ($user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });
    }
}
