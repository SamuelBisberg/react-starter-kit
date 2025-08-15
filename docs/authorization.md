# Authorization

## Overview

This application uses a flexible, role-based access control (RBAC) system built on top of the [spatie/laravel-permission](https://github.com/spatie/laravel-permission) package.  
It is extended with:

- A **[custom Team model](../app/Models/Team.php)** to support multi-team functionality.
- A **[custom Permission model](../app/Models/Permission.php)** integrating [`HasTags`](https://spatie.be/docs/laravel-tags) from Spatie’s Taggable package.
- A **[Guard enum](../app/Enums/GuardEnum.php)** to centralize and standardize `guard_name` values.
- A **[Tags enum](../app/Enums/TagEnum.php)** to ensure consistent tagging vocabulary for permissions.

This design enables fine-grained permission management, multi-team isolation, and advanced permission categorization.

---

## Key Concepts

### [Users](../app/Models/User.php)

- Represents members of the application.
- A user can belong to multiple teams.
- Roles and permissions can be scoped per team.

### [Teams](../app/Models/Team.php)

- Encapsulates a group of users, roles, and permissions.
- Supports team-specific role assignments.

### [Roles](../app/Models/Role.php)

- Group permissions into reusable sets.
- Assigned to users on a per-team basis.

### [Permissions](../app/Models/Permission.php)

- Custom model that supports tagging via the [`HasTags`](https://spatie.be/docs/laravel-tags) trait.
- Tags allow grouping and filtering of permissions by category, feature, or scope.
- Guard values are controlled by [GuardEnum](../app/Enums/GuardEnum.php).

### Tags

- Provided via Spatie’s Taggable package.
- Categories are restricted by the [TagEnum](../app/Enums/TagEnum.php).

---

## Team Support

Enable team support by setting the `SPATIE_PERMISSION_TEAMS` environment variable to `true` in your `.env` file:

```bash
SPATIE_PERMISSION_TEAMS=true
```

---

## ERD

Below is the high-level entity relationship diagram for the authorization system:

![ERD for Authentication](./images/authentication.drawio.svg)

## Permission Checks: Global vs. Type-Specific

The authorization system supports two ways to check permissions:

- **Global Permission**: Grants access to a permission regardless of the resource type.  
  Example: A user with the `paneric` permission can perform the action on any resource.

- **Type-Specific Permission**: Grants access only for a specific resource type.  
  Example: A user with the `paneric:App\\Models\\Post` permission can perform the action only on `Post` resources.

When checking permissions, the system will allow access if the user has either the global permission or the type-specific permission. This dual approach enables both broad and fine-grained access control.

---

## ByPermissionPolicy: Dynamic and Extensible Permission Checks

The `ByPermissionPolicy` class provides a flexible way to resolve permissions for any action. It works by:

- Dynamically mapping method calls (like `$policy->view($user, $model)`) to the corresponding `PermissionEnum` value.
- Checking if the user has the required permission, either globally or for the specific type (using the `forType` method).
- Allowing you to customize the authorization flow with `before` and `after` hooks.

### How It Works

1. **Dynamic Resolution**:  
   When you call a method (e.g., `view`, `update`), the policy checks if a matching constant exists in `PermissionEnum`. If so, it uses that permission for the check.

2. **Permission Check**:  
    The `can` method allows access if the user:
   - Is a staff member, or
   - Has the global permission (e.g., `paneric`), or
   - Has the type-specific permission (e.g., `paneric:App\\Models\\Post`).

3. **Hooks for Customization**:

- `before`: Override this to run logic before the main check. If it returns a `deny`, it short-circuits the check (e.g., must be admin). If it does deny, the main `can` check runs.
- `after`: Override this to run logic only if the main `can` check fails. This can be used for fallback denial, logging, or to attempt a secondary check if needed.

### Extending ByPermissionPolicy

To customize permission logic for a specific resource, extend `ByPermissionPolicy` and override the `before`, `can`, or `after` methods as needed. For example:

```php
class PostPolicy extends ByPermissionPolicy
{
  protected function before(User $user, Model|string $model, PermissionEnum $permission): Response
  {
    if ($user->isSuperAdmin()) {
      return Response::allow();
    }
    return parent::before($user, $model, $permission);
  }
}
```

This approach ensures all permission checks are consistent, DRY, and easily extensible for advanced scenarios.

## Admin Panel

The admin panel is built using [Filament](https://filamentadmin.com/) and provides a user-friendly interface for managing users, teams, roles, and permissions.

The permissions are divided by `tags`, allowing for better organization and filtering.

### Access Control with the Admin Guard

The admin panel is protected by a dedicated **admin guard** to ensure that only authorized users can access it.

Only users with the `view` permission for the `admin` guard can access the admin panel.

---

## Seed Permissions

Edit [database/seeders/PermissionSeeder.php](../database/seeders/PermissionSeeder.php) to define the initial permissions for your application.

---

## Super Admin

The Super Admin role has full access to all resources and permissions within the application. This is done using the `Gate::before` method in the `AppServiceProvider` to automatically grant all permissions to users with this role.

## Manage Staff

You can add staff member on the **Manage Staff** page in the admin panel.

_Note_: Only users with the `manage` permission for the `admin` guard can add staff members.

### Seed Super Admin

Run the `SuperAdminSeeder` to create a super admin user with all permissions.

```bash
php artisan db:seed --class=SuperAdminSeeder

```

You can define a `SuperAdmin` user with the environment variables in your `.env` file:

```bash
SUPER_ADMIN_EMAIL=superadmin@example.com
SUPER_ADMIN_PASSWORD=securepassword
```

---
