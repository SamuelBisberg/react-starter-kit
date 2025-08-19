<?php

namespace App\Filament\Resources\Permissions\Pages;

use App\Enums\GuardEnum;
use App\Filament\Resources\Permissions\PermissionResource;
use App\Models\Permission;
use Filament\Actions\CreateAction;
use Filament\Resources\Concerns\HasTabs;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPermissions extends ListRecords
{
    use HasTabs;

    protected static string $resource = PermissionResource::class;

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
                    ->badge(Permission::query()->where('guard_name', $guard->value)->count())
                    ->modifyQueryUsing(fn (Builder $query) => $query->where('guard_name', $guard->value))
            )
            ->merge([
                Tab::make('all')
                    ->label('All')
                    ->badge(Permission::query()->count())
                    ->modifyQueryUsing(fn (Builder $query) => $query),
            ])
            ->toArray();
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 4;
    }
}
