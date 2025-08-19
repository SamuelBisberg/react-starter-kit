<?php

namespace App\Filament\Resources\Users\Pages;

use App\Enums\GuardEnum;
use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Resources\Concerns\HasTabs;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    use HasTabs;

    protected static string $resource = UserResource::class;

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
                    ->badge(User::query()->whereHas('roles', fn (Builder $query) => $query->where('guard_name', $guard->value))->count())
                    ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('roles', fn (Builder $query) => $query->where('guard_name', $guard->value)))
            )
            ->merge([
                Tab::make('all')
                    ->label('All')
                    ->badge(User::query()->count())
                    ->modifyQueryUsing(fn (Builder $query) => $query),
            ])
            ->toArray();
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 4;
    }
}
