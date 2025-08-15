<?php

namespace App\Enums;

enum PermissionTagEnum: string
{
    case RECORDS = 'records';
    case HISTORY = 'history';
    case IMPORT_EXPORT = 'import_export';
    case ADMIN = 'admin';
    case SECURITY = 'security';
    case COLLABORATION = 'collaboration';
    case SYSTEM = 'system';

    public function label(): string
    {
        return match ($this) {
            self::RECORDS => __('Records'),
            self::HISTORY => __('History'),
            self::IMPORT_EXPORT => __('Import & Export'),
            self::ADMIN => __('Administration'),
            self::SECURITY => __('Security'),
            self::COLLABORATION => __('Collaboration'),
            self::SYSTEM => __('System Operations'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::RECORDS => __('Permissions related to viewing, creating, updating, and deleting records'),
            self::HISTORY => __('Permissions related to viewing historical data and changes'),
            self::IMPORT_EXPORT => __('Permissions related to importing, exporting, and reporting data'),
            self::ADMIN => __('Permissions for managing users, roles, teams, and settings'),
            self::SECURITY => __('Permissions for approving, locking, publishing, or restricting access'),
            self::COLLABORATION => __('Permissions for assigning, commenting, or working in teams'),
            self::SYSTEM => __('Permissions for executing actions or syncing data with other systems'),
        };
    }
}
