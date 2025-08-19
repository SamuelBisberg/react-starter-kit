declare namespace App.Data {
  export type InertiaRequestData = {
    errors: Record<string, string | Array<string>>;
    user: App.Data.UserData | null;
    team: App.Data.TeamData | null;
    can: Array<string>;
    ziggy: Record<string, string | Array<string>>;
    sidebarOpen: boolean;
  };
  export type TeamData = {
    name: string;
    description: string | null;
    order_column: number;
    color: string | null;
    owner: App.Data.UserData;
  };
  export type UserData = {
    name: string;
    email: string;
    avatar: string | null;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string | null;
  };
}
declare namespace App.Enums {
  export type AdminPermissionEnum = 'access' | 'manage';
  export type AdminRoleEnum = 'super_admin' | 'admin';
  export type ApiPermissionEnum = 'all_access' | 'read_only';
  export type GuardEnum = 'web' | 'api' | 'admin';
  export type PermissionEnum =
    | 'view'
    | 'create'
    | 'update'
    | 'delete'
    | 'export'
    | 'import'
    | 'archive'
    | 'restore'
    | 'force_delete'
    | 'duplicate'
    | 'merge'
    | 'comment'
    | 'assign'
    | 'manage_settings'
    | 'manage_permissions';
  export type PermissionTagEnum = 'records' | 'history' | 'import_export' | 'admin' | 'security' | 'collaboration' | 'system';
  export type RoleEnum = 'super-admin' | 'admin' | 'user' | 'viewer';
  export type WebPermissionEnum =
    | 'view'
    | 'create'
    | 'update'
    | 'delete'
    | 'export'
    | 'import'
    | 'archive'
    | 'restore'
    | 'force_delete'
    | 'duplicate'
    | 'merge'
    | 'comment'
    | 'assign'
    | 'manage_settings'
    | 'manage_permissions';
  export type WebRoleEnum = 'admin' | 'user' | 'viewer';
}
