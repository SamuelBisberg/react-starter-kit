<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Team;
use App\Models\User;
use App\Support\PolicyUtils;
use Illuminate\Auth\Access\Response;

class TeamPolicy extends ByPermissionPolicy
{
    protected function after(User $user, $model, PermissionEnum $permission): Response
    {
        return PolicyUtils::isOwner($user, $model) ?
            Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): Response
    {
        return $this->viewAny($user) ?
            Response::allow() : parent::view($user, $team);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return Response::allow();
    }
}
