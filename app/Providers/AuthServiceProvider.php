<?php

namespace App\Providers;

use App\Models\Episode;
use App\Models\Page;
use App\Models\Profile;
use App\Models\User;
use App\Policies\EpisodePolicy;
use App\Policies\PagePolicy;
use App\Policies\ProfilePolicy;
use App\Policies\UserPolicy;
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
        Page::class => PagePolicy::class,
        User::class => UserPolicy::class,
        Profile::class => ProfilePolicy::class,
        Episode::class => EpisodePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
