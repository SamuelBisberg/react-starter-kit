<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Enums\GuardEnum;
use App\Filament\Resources\Roles\RoleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Concerns\HasTabs;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

class ListRoles extends ListRecords
{
    use HasTabs;

    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return collect(GuardEnum::cases())
            ->map(
                fn ($guard) => Tab::make($guard->value)
                    ->label($guard->label())
                    ->badge(Role::query()->where('guard_name', $guard->value)->count())
                    ->modifyQueryUsing(fn (Builder $query) => $query->where('guard_name', $guard->value))
            )
            ->merge([
                Tab::make('all')
                    ->label('All')
                    ->badge(Role::query()->count())
                    ->modifyQueryUsing(fn (Builder $query) => $query),
            ])
            ->toArray();
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 4;
    }
}
