<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LaravelPulseWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make('Laravel Pulse', null)
                ->label('Laravel Pulse')
                ->icon('heroicon-o-heart')
                ->color('primary')
                ->description('Monitor with Laravel Pulse.')
                ->descriptionIcon('heroicon-o-arrow-top-right-on-square')
                ->url(url(config('pulse.path')), shouldOpenInNewTab: true),
        ];
    }
}
