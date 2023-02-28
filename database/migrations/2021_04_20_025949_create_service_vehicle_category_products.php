<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceVehicleCategoryProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_vehicle_category_products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->decimal('qty', 10, 2);
            $table->decimal('service_price', 16, 2);

            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id', 'svcp_svc')->references('id')->on('service_vehicle_categories');

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_vehicle_category_products');
    }
}
