<?php

namespace App\Providers;

use App\Enums\AdminPermissionEnum;
use App\Enums\GuardEnum;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        // Horizon::routeSmsNotificationsTo('15556667777');
        Horizon::routeMailNotificationsTo(config('app.email-addresses.maintenance'));
        // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewHorizon', function (?User $user = null) {
            setPermissionsTeamId($user?->getCurrentTeam());

            return $user?->can(AdminPermissionEnum::ACCESS, GuardEnum::ADMIN->value) ?? false;
        });
    }
}
