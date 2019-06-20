<?php

use App\Enums\RoleType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $admin = User::create([
            'first_name' => 'Administrator',
            'last_name' => 'Account',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $admin->assignRole(RoleType::ADMINISTRATOR);
    }
}
