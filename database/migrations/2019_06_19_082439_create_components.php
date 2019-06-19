<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('component_categories', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('components', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('component_category_id')->index();

            $table->string('title');
            $table->string('vendor_code');

            $table->unsignedInteger('quantity')->default(0);
            $table->float('price')->default(0.00);

            $table->float('cost')->nullable(); // Calculates with DB triggers

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
        Schema::dropIfExists('component_categories');
    }
}
