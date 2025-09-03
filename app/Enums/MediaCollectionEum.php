<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum MediaCollectionEum: string
{
    use EnumTrait;

    case DEFAULT = 'default';
    case IMAGES = 'images';
    case DOCS = 'docs';

    public function label(): string
    {
        return match ($this) {
            self::DEFAULT => __('Default'),
            self::IMAGES => __('Images'),
            self::DOCS => __('Documents'),
        };
    }

    public function disk(): string
    {
        return match ($this) {
            self::DEFAULT => 'local',
            self::IMAGES => 'public',
            self::DOCS => 'private',
        };
    }
}
