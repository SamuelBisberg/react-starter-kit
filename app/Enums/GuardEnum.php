<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum GuardEnum: string
{
    use EnumTrait;

    case WEB = 'web';
    case API = 'api';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::WEB => __('Web'),
            self::API => __('API'),
            self::ADMIN => __('Admin'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::WEB => __('Website login for regular users'),
            self::API => __('API access for external applications'),
            self::ADMIN => __('Admin panel access for management'),
        };
    }
}
