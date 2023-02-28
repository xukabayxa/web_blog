<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegentLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regent_language', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('regent_id');
            $table->string('language');
            $table->string('full_name');
            $table->string('address')->nullable();
            $table->string('role');
            $table->text('description');
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
        Schema::dropIfExists('regent_language');
    }
}
