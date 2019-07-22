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
                'name' => __('components.category_migration.rootCategory'),
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        ComponentCategory::insert([
            [
                'name' => __('components.category_migration.laptop'),
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('components.category_migration.pc'),
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('components.category_migration.phone'),
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
