<?php

use App\Models\ComponentCategory;
use Illuminate\Database\Seeder;

class CreateRootComponentCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ComponentCategory::create([
            'name' => 'Main',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
