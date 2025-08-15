<?php

namespace App\Providers;

use App\Enums\RoleEnum;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::before(fn($user, string $ability) => $user?->hasRole(RoleEnum::SUPER_ADMIN) ? true : null);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
