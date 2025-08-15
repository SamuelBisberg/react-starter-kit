<?php

namespace App\Support;

use App\Enums\GuardEnum;
use App\Interfaces\BelongsToUserInterface;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class with utility methods for handling policies.
 */
class PolicyUtils
{
    /**
     * Check if the user and model have intersecting teams.
     */
    public static function hasIntersectingTeams(User $user, Model $model): bool
    {
        return Team::query()
            ->whereIn('id', $user->teams()->union($user->ownedTeams())->select('id'))
            ->whereIn('id', $user->when(
                $model instanceof User,
                fn () => $model->teams()->union($model->ownedTeams())->select('id'),
                fn () => $model->teams()->select('id')
            ))
            ->exists();
    }

    /**
     * Check if the user is the owner of the model.
     */
    public static function isOwner(User $user, BelongsToUserInterface $model): bool
    {
        return $model->owner()->is($user);
    }

    /**
     * Check if the user is a staff member.
     */
    public static function isStaffMember(User $user): bool
    {
        return $user
            ->roles()
            ->where('guard_name', GuardEnum::ADMIN->value)
            ->exists();
    }
}
