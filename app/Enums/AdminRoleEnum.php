<?php

namespace App\Enums;

use App\Traits\EnumTrait;
use App\Traits\RoleEnumTrait;

enum AdminRoleEnum: string
{
    use EnumTrait, RoleEnumTrait;

    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => __('Super Admin'),
            self::ADMIN => __('Admin'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => __('Full access to all resources'),
            self::ADMIN => __('Admin panel access for management'),
        };
    }

    /**
     * @return array<AdminPermissionEnum>
     */
    public function permissions(): array
    {
        return match ($this) {
            self::SUPER_ADMIN => AdminPermissionEnum::cases(),
            self::ADMIN => [
                AdminPermissionEnum::ACCESS,
            ],
        };
    }
}
