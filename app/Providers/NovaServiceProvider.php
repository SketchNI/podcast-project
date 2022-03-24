<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\User;
use App\Nova\Metrics\Episodes;
use App\Nova\Metrics\Pages;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\UsersPerMonth;
use App\Observers\PageObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Gate;
use JetBrains\PhpStorm\Pure;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::serving(function() {
            User::observe(UserObserver::class);
            Page::observe(PageObserver::class);
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    #[Pure]
    protected function cards(): array
    {
        return [
            new UsersPerDay,
            new UsersPerMonth,
            new Episodes,
            new Pages,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards(): array
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
