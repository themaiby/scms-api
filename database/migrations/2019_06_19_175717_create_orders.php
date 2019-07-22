<?php

use App\Enums\OrderStatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('order_statuses', static function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')->unique();
            $table->string('color')->default('primary');
            $table->string('description')->nullable();

            $table->enum('type', OrderStatusType::getValues());

            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('order_types', static function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')->unique();
            $table->string('color')->default('primary');

            $table->timestamps();
        });

        Schema::create('orders', static function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('order_status_id')->index();
            $table->unsignedBigInteger('order_type_id')->index();

            $table->string('client_name');
            $table->string('client_number');
            $table->string('client_description')->nullable();

            $table->string('device_name');
            $table->string('device_code');
            $table->string('device_description')->nullable();

            $table->string('order_reason');
            $table->timestamp('finish_date');

            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::table('orders', static function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('order_status_id')
                ->references('id')
                ->on('order_statuses')
                ->onDelete('cascade');
            $table->foreign('order_type_id')
                ->references('id')
                ->on('order_types')
                ->onDelete('cascade');
        });

        Schema::create('order_partners', static function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('partner_id')->index();
        });

        Schema::table('order_partners', static function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->foreign('partner_id')
                ->references('id')
                ->on('partners')
                ->onDelete('cascade');
        });

        Schema::create('order_works', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index();
            $table->string('title');
            $table->float('price');
            $table->timestamps();
        });

        Schema::table('order_works', static function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
        });

        Schema::create('order_components', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('component_id')->index();
            $table->unsignedBigInteger('quantity');
            $table->timestamps();
        });

        Schema::table('order_components', static function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
