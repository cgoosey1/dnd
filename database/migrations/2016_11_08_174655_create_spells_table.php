<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spells', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('casting_time');
            $table->string('components');
            $table->integer('concentration');
            $table->string('duration');
            $table->integer('level');
            $table->string('source');
            $table->string('range');
            $table->integer('ritual');
            $table->string('school');
            $table->string('classes');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('spells');
    }
}
