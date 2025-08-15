<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::firstOrCreate([
            'email' => config('app.super-admin.email'),
        ], [
            'name' => config('app.super-admin.name'),
            'email_verified_at' => now(),
            'password' => bcrypt(config('app.super-admin.password')),
        ]);

        if (config('permission.teams')) {
            setPermissionsTeamId($superAdmin->ownedTeams()->firstOrCreate([
                'name' => "Admin's Team",
            ]));
        }

        $superAdmin->assignRole(RoleEnum::SUPER_ADMIN);
    }
}
