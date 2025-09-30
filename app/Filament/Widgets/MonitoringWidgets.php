<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonitoringWidgets extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected function getHeading(): string
    {
        return __('Monitoring');
    }

    protected function getStats(): array
    {
        return [
            // Laravel Pulse
            Stat::make('Laravel Pulse', null)
                ->label('Laravel Pulse')
                ->icon('heroicon-o-heart')
                ->color('primary')
                ->description('Monitor with Laravel Pulse.')
                ->descriptionIcon('heroicon-o-arrow-top-right-on-square')
                ->url(url(config('pulse.path')), shouldOpenInNewTab: true),

            // Laravel Horizon
            Stat::make('Laravel Horizon', null)
                ->label('Laravel Horizon')
                ->icon('heroicon-o-queue-list')
                ->color('warning')
                ->description('Monitor queues with Horizon.')
                ->descriptionIcon('heroicon-o-arrow-top-right-on-square')
                ->url(url(config('horizon.path')), shouldOpenInNewTab: true),

            // Log Viewer
            Stat::make('Log Viewer', null)
                ->label('Log Viewer')
                ->icon('heroicon-o-document-text')
                ->color('danger')
                ->description('Inspect application logs.')
                ->descriptionIcon('heroicon-o-arrow-top-right-on-square')
                ->url(url(config('log-viewer.route_path', 'log-viewer')), shouldOpenInNewTab: true),
        ];
    }
}
