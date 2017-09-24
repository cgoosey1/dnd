<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonsters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('locationId');
            $table->integer('buildingId')->nullable();
            $table->string('name')->nullable();
            $table->string('type');
            $table->text('description')->nullable();
            $table->integer('class');
            $table->integer('hp');
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('hp');
            $table->integer('ac');
            $table->integer('speed');
            $table->integer('str');
            $table->integer('dex');
            $table->integer('con');
            $table->integer('int');
            $table->integer('wis');
            $table->integer('cha');
            $table->string('skills');
            $table->string('savingThrows');
            $table->string('damageVulnerabilities');
            $table->string('damageResistances');
            $table->string('damageImmunities');
            $table->string('conditionImmunities');
            $table->string('senses');
            $table->string('languages');
            $table->string('challenge');
            $table->text('action');
            $table->text('abilities');
            $table->text('reactions');
            $table->timestamps();
        });

        Schema::table('characters', function ($table) {
            $table->integer('class');
            $table->integer('hp');
            $table->dropColumn('stats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('monsters');
        Schema::drop('classes');
        Schema::table('characters', function ($table) {
            $table->dropColumn('class');
            $table->dropColumn('hp');
            $table->json('stats');
        });
    }
}
