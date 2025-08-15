<?php

namespace Database\Seeders;

use App\Enums\GuardEnum;
use App\Enums\PermissionEnum;
use App\Enums\PermissionTagEnum;
use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Support\ReflectionCollection;
use App\Support\TranslationUtils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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
            ->map(fn(PermissionTagEnum $permissionTagEnum) => Tag::findOrCreate($permissionTagEnum->label(), Permission::class))
            ->each(fn(Tag $tag) => $tag->setTranslations('name', TranslationUtils::translatedToAllLocales($tag->name)->toArray()));

        // Seed permissions
        collect(PermissionEnum::cases())->each(function (PermissionEnum $permissionEnum) {
            collect(GuardEnum::cases())->each(function (GuardEnum $guardEnum) use ($permissionEnum) {
                // Seed general Permission
                Permission::findOrCreate(
                    name: $permissionEnum->value,
                    guardName: $guardEnum->value,
                )->syncTags([$permissionEnum->tag()->label()]);

                // Seed Permission per Model
                ReflectionCollection::fromDirectory('Models')
                    ->isSubclassOf(Model::class)
                    ->getClassNames()
                    ->each(function (string $modelClass) use ($permissionEnum, $guardEnum) {
                        Permission::findOrCreate(
                            name: $permissionEnum->forType($modelClass),
                            guardName: $guardEnum->value,
                        )->syncTags([$permissionEnum->tag()->label()]);
                    });
            });
        });

        // Seed default roles
        collect(RoleEnum::cases())->each(function (RoleEnum $roleEnum) {
            collect(GuardEnum::cases())->each(function (GuardEnum $guardEnum) use ($roleEnum) {
                Role::findOrCreate(
                    name: $roleEnum->value,
                    guardName: $guardEnum->value,
                );
            });
        });
    }
}
