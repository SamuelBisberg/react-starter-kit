<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum UserMediaCollectionEum: string
{
    use EnumTrait;

    case PROFILE_PICTURE = 'profile-picture';
    case IMAGES = 'images';
    case DOCS = 'docs';

    public function label(): string
    {
        return match ($this) {
            self::IMAGES => __('Images'),
            self::DOCS => __('Documents'),
            self::PROFILE_PICTURE => __('Profile Picture'),
        };
    }

    public function disk(): string
    {
        return match ($this) {
            self::IMAGES, self::PROFILE_PICTURE => 'public',
            self::DOCS => 'local',
        };
    }
}
