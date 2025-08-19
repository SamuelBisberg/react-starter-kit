<?php

namespace App\Filament\Resources\Permissions\Tables;

use App\Enums\AdminPermissionEnum;
use App\Enums\ApiPermissionEnum;
use App\Enums\GuardEnum;
use App\Enums\WebPermissionEnum;
use App\Support\ReflectionCollection;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PermissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->formatStateUsing(function ($state) {
                        if (strpos($state, ':') !== false) {
                            [$can, $on] = explode(':', $state, 2);

                            return "can: {$can} on: {$on}";
                        }

                        return $state;
                    })
                    ->badge()
                    ->searchable(),
                IconColumn::make('guard_name')
                    ->icon(fn ($record) => match (GuardEnum::tryFrom($record->guard_name)) {
                        GuardEnum::ADMIN => Heroicon::User,
                        GuardEnum::WEB => Heroicon::UserGroup,
                        GuardEnum::API => Heroicon::Key,
                        default => Heroicon::ShieldCheck,
                    })
                    ->color(fn ($record) => match (GuardEnum::tryFrom($record->guard_name)) {
                        GuardEnum::ADMIN => 'info',
                        GuardEnum::WEB => 'primary',
                        GuardEnum::API => 'success',
                        default => 'warning',
                    })
                    ->tooltip(fn ($record) => $record->guard_name)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('guard_name')
                    ->label('Guard')
                    ->options(GuardEnum::plucked()),
                SelectFilter::make('class')
                    ->label('Class')
                    ->options(
                        ReflectionCollection::fromDirectory('Models')
                            ->isSubclassOf(Model::class)
                            ->getClassNames()
                            ->map(fn ($class) => [
                                'value' => $class,
                                'label' => class_basename($class),
                            ])
                            ->pluck('label', 'value')
                    )
                    ->query(fn ($query, $data) => $query->when($data['value'] ?? null, function ($query) use ($data) {
                        $value = str_replace('\\', '\\\\', $data['value']);

                        return $query->where('name', 'like', "%{$value}");
                    })),

                SelectFilter::make('ability')
                    ->label('Ability')
                    ->options(
                        collect(WebPermissionEnum::plucked())
                            ->merge(ApiPermissionEnum::plucked())
                            ->merge(AdminPermissionEnum::plucked())
                    )
                    ->query(fn ($query, $data) => $query->when($data['value'] ?? null, fn ($query) => $query->where('name', 'like', "{$data['value']}%"))),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
