<?php

use App\Enums\PermissionType;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /** Remove all permissions from cache */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /** Global admin Role (has all permissions) */
        Role::create(['name' => 'administrator']);

        $permissions = PermissionType::getValues();

        $permissionsReadyToInsert = [];
        foreach ($permissions as $permission) {
            $permissionsReadyToInsert[] = [
                'name' => $permission,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Permission::insert($permissionsReadyToInsert);
    }
}
