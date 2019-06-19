<?php

use App\Models\ComponentCategory;
use Illuminate\Database\Seeder;

class ComponentCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ComponentCategory::insert([
            [
                'name' => __('components.category_migration.laptop'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('components.category_migration.pc'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('components.category_migration.phone'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
