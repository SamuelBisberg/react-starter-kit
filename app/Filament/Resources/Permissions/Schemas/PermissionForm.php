<?php

namespace App\Filament\Resources\Permissions\Schemas;

use App\Enums\GuardEnum;
use App\Enums\PermissionEnum;
use App\Support\ReflectionCollection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class PermissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ability')
                    ->options(PermissionEnum::plucked())
                    ->placeholder('Select ability')
                    ->label('Ability')
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set, $get) => $set('name', $get('class') ? "$state:{$get('class')}" : $state)),

                Select::make('class')
                    ->options(
                        ReflectionCollection::fromDirectory("Models")
                            ->isSubclassOf(Model::class)
                            ->getClassNames()
                            ->map(fn($class) => [
                                'value' => $class,
                                'label' => class_basename($class),
                            ])
                            ->pluck('label', 'value')
                    )

                    ->reactive()
                    ->placeholder('Select model')
                    ->label('Model')
                    ->afterStateUpdated(fn($state, callable $set, $get) => $set('name', $state ? "{$get('ability')}:$state" : $get('ability'))),

                TextInput::make('name')
                    ->required()
                    ->columnSpan(2)
                    ->reactive(), // update dynamically when set programmatically

                Select::make('guard_name')
                    ->required()
                    ->options(GuardEnum::plucked()),
            ]);
    }
}
