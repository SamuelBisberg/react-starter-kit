<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;
use App\Support\PolicyUtils;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

/**
 * Policy to manage permissions based on user permissions
 */
class ByPermissionPolicy
{
    /**
     * Determine if the user can perform the action on the model.
     */
    protected function can(User $user, Model|string $model, PermissionEnum $permission): Response
    {
        return Gate::allowIf(
            PolicyUtils::isStaffMember($user) ||
                $user->hasPermissionTo($permission) ||
                $user->hasPermissionTo($permission->forType(is_string($model) ? $model : $model::class))
        )->denyAsNotFound();
    }

    /**
     * Apply before hook for permission checks.
     * Use in derived if you want to early return a response.
     */
    protected function before(User $user, Model|string $model, PermissionEnum $permission): Response
    {
        return Response::allow();
    }

    /**
     * Apply after hook for permission checks.
     * Use in derived if you add additional checks for allowing.
     */
    protected function after(User $user, Model|string $model, PermissionEnum $permission): Response
    {
        return Response::denyAsNotFound();
    }

    /**
     * Handle dynamic method calls to check permissions.
     */
    public function __call($method, $arguments): Response
    {
        if (! defined(PermissionEnum::class.'::'.strtoupper($method))) {
            throw new \BadMethodCallException("Method {$method} does not exist.");
        }

        $permission = constant(PermissionEnum::class.'::'.strtoupper($method));

        $before = $this->before($arguments[0], $arguments[1], $permission);
        if ($before->denied()) {
            return $before;
        }

        $can = $this->can($arguments[0], $arguments[1], $permission);
        if ($can->allow()) {
            return $can;
        }

        return $this->after($arguments[0], $arguments[1], $permission);
    }
}
