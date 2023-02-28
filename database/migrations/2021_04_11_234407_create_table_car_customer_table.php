<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCarCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_customer', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('car_id')->unsigned()->index();
            $table->foreign('car_id')->references('id')->on('cars');

            $table->unsignedBigInteger('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers');

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
        Schema::dropIfExists('car_customer');
    }
}
