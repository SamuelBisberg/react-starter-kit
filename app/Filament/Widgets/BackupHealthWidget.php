<?php

namespace App\Filament\Widgets;

use Filament\Support\Colors\Color;
use Filament\Widgets\ChartWidget;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
use Spatie\Backup\Config\MonitoredBackupsConfig;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatus;
use \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumStorageInMegabytes;

class BackupHealthWidget extends ChartWidget
{
    protected ?MonitoredBackupsConfig $config = null;

    protected ?BackupDestinationStatus $status = null;

    protected ?string $heading = 'Backup Health Widget';

    protected static bool $isLazy = true;

    public static function canView(): bool
    {
        return (bool)config('backup.enabled');
    }

    public function __construct()
    {
        $this->config = MonitoredBackupsConfig::fromArray(config('backup.monitor_backups'));
        $this->status = BackupDestinationStatusFactory::createForMonitorConfig($this->config)->first();
    }

    public function getHeading(): string
    {
        return "Backup Health";
    }

    public function getDescription(): string
    {
        $status = $this->status->isHealthy() ? 'Healthy' : 'Unhealthy';
        $lastBackup = $this->status->backupDestination()->backups()->first();
        $timeAgo = $lastBackup ? $lastBackup->date()->diffForHumans() : 'unknown time';

        return "Last backup {$timeAgo} ({$status})";
    }

    protected function getData(): array
    {
        $maximumStorage = config('backup.monitor_backups.0.health_checks')[MaximumStorageInMegabytes::class] ?? 0;

        $usedStorage = round($this->status->backupDestination()->usedStorage() / 1024 / 1024, 2); // bytes to MB

        $availableStorage = max($maximumStorage - $usedStorage, 0);

        $usagePercentage = $maximumStorage > 0 ? ($usedStorage / $maximumStorage) * 100 : 0;

        $usedColor = match (true) {
            ! $this->status->isHealthy() => Color::Red[600],
            $usagePercentage > 80 => Color::Orange[600],
            default => Color::Green[600],
        };

        return [
            'labels' => [
                "Used ({$usedStorage}MB)",
                "Available ({$availableStorage}MB)"
            ],
            'datasets' => [
                [
                    'data' => [$usedStorage, $availableStorage],
                    'backgroundColor' => [$usedColor, Color::Neutral[300]],
                    'borderColor' => [$usedColor, Color::Neutral[400]],
                    'borderWidth' => 2,
                ],
            ],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
            'maintainAspectRatio' => false,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
