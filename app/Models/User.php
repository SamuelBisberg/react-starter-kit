<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\AdminPermissionEnum;
use App\Enums\AdminRoleEnum;
use App\Enums\GuardEnum;
use App\Interfaces\HasTitleAttributeName;
use App\Traits\InteractsWithTeam;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasMedia, HasTitleAttributeName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, InteractsWithMedia, InteractsWithTeam, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function getTitleAttributeName(): string
    {
        return 'name';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function guardName()
    {
        return [
            GuardEnum::WEB->value,
            GuardEnum::ADMIN->value,
        ];
    }

    public function teams(): BelongsToMany
    {
        return $this->morphToMany(Team::class, 'model', 'model_has_roles');
    }

    public function ownedTeams(): HasMany
    {
        return $this->hasMany(Team::class, 'owner_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        setPermissionsTeamId($this->getCurrentTeam());

        if ($this->hasRole(AdminRoleEnum::SUPER_ADMIN)) {
            return true;
        }

        return match ($panel->getId()) {
            'admin' => $this->hasPermissionTo(AdminPermissionEnum::ACCESS, GuardEnum::ADMIN->value),
            // Add access for other panels here
            default => false,
        };
    }
}
