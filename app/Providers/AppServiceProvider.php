<?php

namespace App\Providers;

use App\Enums\AdminRoleEnum;
use App\Enums\GuardEnum;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::before(fn ($user, string $ability) => $user?->hasRole(AdminRoleEnum::SUPER_ADMIN, GuardEnum::ADMIN->value) ? true : null);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
