<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('bets'); // Eliminar la tabla si ya existe

        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_schedule')->constrained('schedule_results');
            $table->integer('score_team1')->nullable();
            $table->integer('score_team2')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('bets', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_schedule']);
        });

        Schema::dropIfExists('bets');
    }
}