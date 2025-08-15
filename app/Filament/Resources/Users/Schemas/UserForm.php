<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
                TextInput::make('password_confirmation')
                    ->label('Confirm Password')
                    ->password()
                    ->same('password')
                    ->dehydrated(false)
                    ->required(fn (string $context): bool => $context === 'create'),
                DateTimePicker::make('email_verified_at')
                    ->label('Email verified at')
                    ->maxDate(now()->endOfDay()),
            ]);
    }
}
