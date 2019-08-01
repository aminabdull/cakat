<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_scores', function (Blueprint $table) {
            $table->increments('id')->index(); 
            $table->string('username');
            $table->smallInteger('gameid')->index();
            $table->smallInteger('score');
            $table->smallInteger('time');
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
        Schema::dropIfExists('users_scores');
    }
}
