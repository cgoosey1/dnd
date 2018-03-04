<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('abilityScoreIncrease');
            $table->string('age');
            $table->string('alignment');
            $table->string('size');
            $table->integer('speed');
            $table->integer('parentId')->nullable();
            $table->timestamps();
        });

        Schema::create('race_proficiency', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('race_id');
            $table->integer('proficiency_id');
            $table->timestamps();
        });

        Schema::create('proficiency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('race_language', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('race_id');
            $table->integer('language_id');
            $table->timestamps();
        });

        Schema::create('language', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('race_trait', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('race_id');
            $table->integer('trait_id');
            $table->timestamps();
        });

        Schema::create('trait', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('showInFeatures');
            $table->string('details');
            $table->string('attributes');
            $table->timestamps();
        });

        Schema::create('race_choice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('race_id');
            $table->integer('choice_id');
            $table->timestamps();
        });

        Schema::create('choice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('details');
            $table->string('key');
            $table->timestamps();
        });

        Schema::create('choice_option', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('choice_id');
            $table->integer('option_id');
            $table->timestamps();
        });

        Schema::create('option', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
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
        Schema::drop('race');
        Schema::drop('race_proficiency');
        Schema::drop('proficiency');
        Schema::drop('race_language');
        Schema::drop('language');
        Schema::drop('race_trait');
        Schema::drop('trait');
        Schema::drop('race_choice');
        Schema::drop('choice');
        Schema::drop('choice_option');
        Schema::drop('option');
    }
}
