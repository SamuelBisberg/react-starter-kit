<?php

namespace App\Interfaces;

/**
 * Interface for models that have a title attribute name.
 */
interface HasTitleAttributeName
{
    /**
     * Get the title attribute name.
     */
    public static function getTitleAttributeName(): string;
}
