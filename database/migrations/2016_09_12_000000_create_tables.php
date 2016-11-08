<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('locationId');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('locationId');
            $table->integer('buildingId')->nullable();
            $table->string('name');
            $table->string('race');
            $table->text('description')->nullable();
            $table->json('stats')->nullable();
            $table->timestamps();
        });

        Schema::create('screens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->integer('typeId');
            $table->string('name');
            $table->string('pic');
            $table->string('audio');
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
        Schema::drop('locations');
        Schema::drop('buildings');
        Schema::drop('characters');
        Schema::drop('screens');
    }
}
