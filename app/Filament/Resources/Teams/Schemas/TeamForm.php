<?php

namespace App\Filament\Resources\Teams\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('order_column')
                    ->numeric(),
                Textarea::make('description')
                    ->columnSpanFull(),
                ColorPicker::make('color')
                    ->label('Color')
                    ->default('#FFFFFF')
                    ->required(),
                Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->required(),
            ]);
    }
}
