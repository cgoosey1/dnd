<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('completed')->default(0);
            $table->timestamps();
        });

        Schema::table('buildings', function ($table) {
            $table->integer('questId')->nullable();
        });

        Schema::table('characters', function ($table) {
            $table->integer('questId')->nullable();
        });

        Schema::table('monsters', function ($table) {
            $table->integer('questId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quests');
        Schema::table('buildings', function ($table) {
            $table->dropColumn('questId');
        });
        Schema::table('characters', function ($table) {
            $table->dropColumn('questId');
        });
        Schema::table('monsters', function ($table) {
            $table->dropColumn('questId');
        });
    }
}
