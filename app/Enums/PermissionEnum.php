<?php

namespace App\Enums;

enum PermissionEnum: string
{
    // Core CRUD
    case VIEW = 'view';
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';

    // Data Operations
    case EXPORT = 'export';
    case IMPORT = 'import';
    case ARCHIVE = 'archive';
    case RESTORE = 'restore';
    case FORCE_DELETE = 'force_delete';
    case DUPLICATE = 'duplicate';
    case MERGE = 'merge';

    // Communication / Interaction
    case COMMENT = 'comment';
    case ASSIGN = 'assign';

    // System-Level
    case MANAGE_SETTINGS = 'manage_settings';
    case MANAGE_PERMISSIONS = 'manage_permissions';

    public function label(): string
    {
        return match ($this) {
            self::VIEW => __('View Records'),
            self::CREATE => __('Create Records'),
            self::UPDATE => __('Update Records'),
            self::DELETE => __('Delete Records'),

            self::EXPORT => __('Export Data'),
            self::IMPORT => __('Import Data'),
            self::ARCHIVE => __('Archive Records'),
            self::RESTORE => __('Restore Records'),
            self::FORCE_DELETE => __('Permanently Delete Records'),
            self::DUPLICATE => __('Duplicate Records'),
            self::MERGE => __('Merge Records'),

            self::COMMENT => __('Comment on Records'),
            self::ASSIGN => __('Assign Records'),

            self::MANAGE_SETTINGS => __('Manage Application Settings'),
            self::MANAGE_PERMISSIONS => __('Manage Permissions & Roles'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::VIEW => __('Allows viewing of records and data'),
            self::CREATE => __('Allows creating new records'),
            self::UPDATE => __('Allows editing existing records'),
            self::DELETE => __('Allows deleting records permanently'),

            self::EXPORT => __('Allows exporting data to files'),
            self::IMPORT => __('Allows importing data from files'),
            self::ARCHIVE => __('Allows archiving old records'),
            self::RESTORE => __('Allows restoring archived or deleted records'),
            self::DUPLICATE => __('Allows creating a copy of an existing record'),
            self::FORCE_DELETE => __('Allows permanently deleting records'),
            self::MERGE => __('Allows merging two or more records'),

            self::COMMENT => __('Allows adding comments to records'),
            self::ASSIGN => __('Allows assigning records to users or teams'),

            self::MANAGE_SETTINGS => __('Allows changing application-wide settings'),
            self::MANAGE_PERMISSIONS => __('Allows modifying permissions and roles'),
        };
    }

    public function tag(): PermissionTagEnum
    {
        return match ($this) {
            self::VIEW,
            self::CREATE,
            self::UPDATE,
            self::DELETE,
            self::DUPLICATE,
            self::MERGE => PermissionTagEnum::RECORDS,

            self::RESTORE,
            self::ARCHIVE,
            self::FORCE_DELETE => PermissionTagEnum::HISTORY,

            self::EXPORT,
            self::IMPORT => PermissionTagEnum::IMPORT_EXPORT,

            self::MANAGE_SETTINGS,
            self::MANAGE_PERMISSIONS => PermissionTagEnum::ADMIN,

            self::ASSIGN,
            self::COMMENT => PermissionTagEnum::COLLABORATION,
        };
    }

    public function forType(string $type): string
    {
        return "{$this->value}:{$type}";
    }
}
