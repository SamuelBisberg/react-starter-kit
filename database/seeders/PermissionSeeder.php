<?php

namespace Database\Seeders;

use App\Enums\AdminPermissionEnum;
use App\Enums\AdminRoleEnum;
use App\Enums\ApiPermissionEnum;
use App\Enums\GuardEnum;
use App\Enums\PermissionTagEnum;
use App\Enums\WebPermissionEnum;
use App\Enums\WebRoleEnum;
use App\Models\Permission;
use App\Support\ReflectionCollection;
use App\Support\TranslationUtils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // // Seed permissions tags
        collect(PermissionTagEnum::cases())
            ->map(fn (PermissionTagEnum $permissionTagEnum) => Tag::findOrCreate($permissionTagEnum->label(), Permission::class))
            ->each(fn (Tag $tag) => $tag->setTranslations('name', TranslationUtils::translatedToAllLocales($tag->name)->toArray()));

        // Seed api permissions
        collect(ApiPermissionEnum::cases())
            ->each(fn ($perm) => $perm->findOrCreate(GuardEnum::API));

        // Admin permissions
        collect(AdminPermissionEnum::cases())
            ->each(fn ($perm) => $perm->findOrCreate(GuardEnum::ADMIN));

        // Seed web generic permissions
        collect(WebPermissionEnum::cases())
            ->each(fn ($perm) => $perm->findOrCreate(GuardEnum::WEB));

        // Seed web per model permissions
        ReflectionCollection::fromDirectory('Models')
            ->isSubclassOf(Model::class)
            ->getClassNames()
            ->each(
                fn ($type) => collect(WebPermissionEnum::cases())
                    ->each(fn ($perm) => $perm->findOrCreate(GuardEnum::WEB, $type))
            );

        // Seed web roles
        collect(WebRoleEnum::cases())
            ->each(fn ($role) => $role->findOrCreate(GuardEnum::WEB));

        // Seed admin roles
        collect(AdminRoleEnum::cases())
            ->each(fn ($role) => $role->findOrCreate(GuardEnum::ADMIN));
    }
}
