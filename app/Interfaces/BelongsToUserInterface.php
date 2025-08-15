<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Interface for models that belong to a user.
 */
interface BelongsToUserInterface
{
    public function owner(): BelongsTo;
}
