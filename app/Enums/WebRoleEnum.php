<?php

namespace App\Enums;

use App\Traits\EnumTrait;
use App\Traits\RoleEnumTrait;

enum WebRoleEnum: string
{
    use EnumTrait, RoleEnumTrait;

    case ADMIN = 'admin';
    case USER = 'user';
    case VIEWER = 'viewer';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => __('Admin'),
            self::USER => __('User'),
            self::VIEWER => __('Viewer'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::ADMIN => __('Admin panel access for management'),
            self::USER => __('Standard user access'),
            self::VIEWER => __('Read-only access'),
        };
    }

    /**
     * @return array<WebPermissionEnum>
     */
    public function permissions(): array
    {
        return match ($this) {
            self::ADMIN => WebPermissionEnum::cases(),
            self::USER => [
                WebPermissionEnum::VIEW,
                WebPermissionEnum::COMMENT,
            ],
            self::VIEWER => [
                WebPermissionEnum::VIEW,
            ],
        };
    }
}
