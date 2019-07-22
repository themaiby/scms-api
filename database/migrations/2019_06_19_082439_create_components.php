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
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->timestamps();
        });

        Schema::table('component_categories', static function (Blueprint $table) {
            $table->unique(['name', 'parent_id']);
            $table->foreign('parent_id')
                ->references('id')
                ->on('component_categories')
                ->onDelete('cascade');
        });

        Schema::create('components', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('component_category_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('vendor_id')->index();

            $table->string('title');
            $table->string('vendor_code');

            $table->unsignedInteger('quantity')->default(0);
            $table->float('price')->default(0.00);
            $table->float('cost')->nullable(); // Calculates with DB triggers

            $table->boolean('active')->default(true);
            $table->timestamps();
        });


        Schema::table('components', static function (Blueprint $table) {
            $table->foreign('component_category_id')
                ->references('id')
                ->on('component_categories')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
                ->onDelete('cascade');
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
