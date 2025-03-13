<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleResultsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('schedule_results'); // Eliminar la tabla si ya existe

        Schema::create('schedule_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_team_1')->constrained('teams');
            $table->foreignId('id_team_2')->constrained('teams');
            $table->integer('score_team1')->nullable();
            $table->integer('score_team2')->nullable();
            $table->foreignId('id_stadium')->constrained('stadiums');
            $table->dateTime('date_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('schedule_results', function (Blueprint $table) {
            $table->dropForeign(['id_team_1']);
            $table->dropForeign(['id_team_2']);
            $table->dropForeign(['id_stadium']);
        });

        Schema::dropIfExists('schedule_results');
    }
}