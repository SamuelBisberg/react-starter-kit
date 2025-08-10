<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;

class UserChart extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $trand = Trend::model(User::class)
            ->between(start: now()->subMonth(), end: now())
            ->perWeek()
            ->count();

        $trandColor = match (true) {
            $trand->count() > 1 && $trand->last()->aggregate > $trand->first()->aggregate => 'success',
            $trand->count() > 1 && $trand->last()->aggregate < $trand->first()->aggregate => 'danger',
            default => 'neutral',
        };

        return [
            Stat::make('New Users', $trand->sum('aggregate'))
                ->icon(Heroicon::ArrowTrendingUp)
                ->description('New users in the last month')
                ->chartColor($trandColor)
                ->chart($trand->pluck('aggregate'))

        ];
    }
}
