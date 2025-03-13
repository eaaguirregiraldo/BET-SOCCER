<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('teams'); // Eliminar la tabla si ya existe

        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tournament')->constrained('tournaments');
            $table->string('name');
            $table->longText('team_shield');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign(['id_tournament']);
        });

        Schema::dropIfExists('teams');
    }
}