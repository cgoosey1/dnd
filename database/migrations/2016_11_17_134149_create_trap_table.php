<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('type');
            $table->integer('difficulty');
            $table->integer('characterLevel');
            $table->string('trigger');
            $table->text('description')->nullable();
            $table->integer('detectDC');
            $table->integer('disarmDC');
            $table->integer('saveDC');
            $table->string('attackMod')->nullable();
            $table->string('damage');
            $table->integer('complex')->default(0);
            $table->integer('template')->default(0);
            $table->integer('initiative')->nullable();
            $table->integer('spell')->nullable();
            $table->integer('spellcasterLevel')->nullable();
            $table->integer('locationId');
            $table->integer('questId')->nullable();
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
        Schema::drop('traps');
    }
}
