<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnNameToStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('en_name')->nullable();
            $table->string('en_phone')->nullable();
            $table->string('en_hotline')->nullable();
            $table->string('en_email')->nullable();
            $table->string('en_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('en_name');
            $table->dropColumn('en_address');
            $table->dropColumn('en_phone')->nullable();
            $table->dropColumn('en_hotline')->nullable();
            $table->dropColumn('en_email')->nullable();
        });
    }
}
