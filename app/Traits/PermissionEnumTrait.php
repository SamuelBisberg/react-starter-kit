<?php

namespace App\Traits;

use App\Enums\GuardEnum;
use App\Models\Permission;

/**
 * Trait for enum of permissions
 */
trait PermissionEnumTrait
{
    use EnumTrait;

    /**
     * Get the permission string for a specific type.
     */
    public function forType(string $type): string
    {
        return "{$this->value}:{$type}";
    }

    /**
     * Find or create a permission for the given guard.
     */
    public function findOrCreate(GuardEnum $guardEnum, ?string $type = null): Permission
    {
        return Permission::findOrCreate(
            name: $type ? $this->forType($type) : $this->value,
            guardName: $guardEnum->value,
        )->syncTags([$this->tag()->label()]);
    }
}
