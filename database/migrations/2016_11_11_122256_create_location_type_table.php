<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('locations', function ($table) {
            $table->integer('type');
            $table->integer('parent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('location_type');
        Schema::table('locations', function ($table) {
            $table->dropColumn('type');
            $table->dropColumn('parent');
        });
    }
}
