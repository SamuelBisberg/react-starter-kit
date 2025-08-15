<?php

namespace App\Models;

use App\Interfaces\BelongsToUserInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Permission\Models\Role;

class Team extends Model implements BelongsToUserInterface, Sortable
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory, SortableTrait;

    const DEFAULT_COLOR = '#ffffff';

    protected $fillable = [
        'order_column',
        'name',
        'description',
        'color',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'model_has_roles', 'team_id', 'model_id')
            ->where('model_type', User::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class, 'team_id');
    }
}
