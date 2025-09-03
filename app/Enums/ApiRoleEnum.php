<?php

namespace App\Enums;

use App\Traits\EnumTrait;
use App\Traits\RoleEnumTrait;

enum ApiRoleEnum: string
{
    use EnumTrait, RoleEnumTrait;

    case READ_WRITE = 'read_write';
    case READ_ONLY = 'read_only';

    public function label(): string
    {
        return match ($this) {
            self::READ_WRITE => __('Read & Write'),
            self::READ_ONLY => __('Read Only'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::READ_WRITE => __('Access to read and write resources'),
            self::READ_ONLY => __('Access to read resources only'),
        };
    }

    /**
     * @return array<ApiPermissionEnum>
     */
    public function permissions(): array
    {
        return match ($this) {
            self::READ_WRITE => ApiPermissionEnum::cases(),
            self::READ_ONLY => [
                ApiPermissionEnum::READ_ONLY,
            ],
        };
    }
}
