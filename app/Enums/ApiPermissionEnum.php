<?php

namespace App\Enums;

use App\Traits\EnumTrait;
use App\Traits\PermissionEnumTrait;

enum ApiPermissionEnum: string
{
    use EnumTrait, PermissionEnumTrait;

    case ALL_ACCESS = 'all_access';
    case READ_ONLY = 'read_only';

    public function label(): string
    {
        return match ($this) {
            self::ALL_ACCESS => __('All Access'),
            self::READ_ONLY => __('Read Only'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::ALL_ACCESS => __('Allows all actions on API endpoints'),
            self::READ_ONLY => __('Allows only read access to API endpoints'),
        };
    }

    public function tag(): PermissionTagEnum
    {
        return match ($this) {
            self::ALL_ACCESS,
            self::READ_ONLY => PermissionTagEnum::RECORDS,
        };
    }
}
