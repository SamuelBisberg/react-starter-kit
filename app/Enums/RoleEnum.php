<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum RoleEnum: string
{
    use EnumTrait;

    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case USER = 'user';
    case VIEWER = 'viewer';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => __('Super Admin'),
            self::ADMIN => __('Admin'),
            self::USER => __('User'),
            self::VIEWER => __('Viewer'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => __('Full access to all resources'),
            self::ADMIN => __('Admin panel access for management'),
            self::USER => __('Standard user access'),
            self::VIEWER => __('Read-only access'),
        };
    }
}
