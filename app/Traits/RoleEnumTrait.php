<?php

namespace App\Traits;

use App\Enums\GuardEnum;
use Spatie\Permission\Models\Role;

/**
 * Trait for enum of roles
 */
trait RoleEnumTrait
{
    use EnumTrait;

    /**
     * Find or create a role for the given guard.
     */
    public function findOrCreate(GuardEnum $guardEnum): Role
    {
        return Role::findOrCreate(
            name: $this->value,
            guardName: $guardEnum->value,
        )->syncPermissions($this->permissions());
    }
}
