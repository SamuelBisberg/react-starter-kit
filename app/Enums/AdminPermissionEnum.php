<?php

namespace App\Enums;

use App\Traits\EnumTrait;
use App\Traits\PermissionEnumTrait;

enum AdminPermissionEnum: string
{
    use EnumTrait, PermissionEnumTrait;

    case ACCESS = 'access';
    case MANAGE = 'manage';

    public function label(): string
    {
        return match ($this) {
            self::ACCESS => __('Access Admin Panel'),
            self::MANAGE => __('Manage Admin Settings'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::ACCESS => __('Allows access to the admin panel'),
            self::MANAGE => __('Allows managing admin settings'),
        };
    }

    public function tag(): PermissionTagEnum
    {
        return match ($this) {
            self::ACCESS,
            self::MANAGE => PermissionTagEnum::ADMIN,
        };
    }
}
