<?php

namespace App\Filament\Resources\Roles\Schemas;

use App\Enums\GuardEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->columnSpan(2)
                    ->required(),
                Select::make('guard_name')
                    ->options(GuardEnum::plucked())
                    ->required(),
                Select::make('team_id')
                    ->relationship('team', 'id')
                    ->default(null),
            ]);
    }
}
