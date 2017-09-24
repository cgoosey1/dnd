<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapMarkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_markers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('x')->default(0);
            $table->integer('y')->default(0);
            $table->integer('size')->default(14);
            $table->string('marker')->default('star');
            $table->string('color')->default('#000');
            $table->string('text')->default('');
            $table->integer('bold')->default(0);
            $table->integer('italic')->default(0);
            $table->integer('underline')->default(0);
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
        Schema::drop('mapMarkers');
    }
}
