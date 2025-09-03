<?php

namespace App\Filament\Resources\Roles\Tables;

use App\Enums\AdminRoleEnum;
use App\Enums\ApiRoleEnum;
use App\Enums\GuardEnum;
use App\Enums\WebRoleEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->formatStateUsing(fn($state, $record) => match (GuardEnum::from($record->guard_name)) {
                        GuardEnum::ADMIN => AdminRoleEnum::from($state)->label(),
                        GuardEnum::WEB => WebRoleEnum::from($state)->label(),
                        GuardEnum::API => ApiRoleEnum::from($state)->label(),
                        default => 'Unknown',
                    })
                    ->searchable(),
                IconColumn::make('guard_name')
                    ->icon(fn($record) => match (GuardEnum::tryFrom($record->guard_name)) {
                        GuardEnum::ADMIN => Heroicon::User,
                        GuardEnum::WEB => Heroicon::UserGroup,
                        GuardEnum::API => Heroicon::Key,
                        default => Heroicon::ShieldCheck,
                    })
                    ->color(fn($record) => match (GuardEnum::tryFrom($record->guard_name)) {
                        GuardEnum::ADMIN => 'info',
                        GuardEnum::WEB => 'primary',
                        GuardEnum::API => 'success',
                        default => 'warning',
                    })
                    ->tooltip(fn($record) => $record->guard_name)
                    ->searchable(),
                TextColumn::make('team.name')
                    ->label('Team')
                    ->sortable()
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
                //
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
