<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Tags\HasTags;

class Permission extends SpatiePermission
{
    use HasTags;
}
