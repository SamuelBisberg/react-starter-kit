<?php

namespace App\Traits;

use Illuminate\Support\Collection;

/**
 * Trait for enums with common methods.
 */
trait EnumTrait
{
    public static function toCollection(): Collection
    {
        /**
         * Convert enum cases to a collection with additional properties.
         */
        return collect(self::cases())
            ->map(fn($case) => [
                'value' => $case->value,
                'name' => $case->name,
                'label' => method_exists($case, 'label') ? $case->label() : null,
                'description' => method_exists($case, 'description') ? $case->description() : null,
                'color' => method_exists($case, 'color') ? $case->color() : null,
            ]);
    }
}
