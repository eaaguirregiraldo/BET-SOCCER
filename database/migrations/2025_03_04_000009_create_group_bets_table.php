<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupBetsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('group_bets'); // Eliminar la tabla si ya existe

        Schema::create('group_bets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tournament')->constrained('tournaments');
            $table->foreignId('id_user_admin')->constrained('users');
            $table->foreignId('id_user_group_bet')->constrained('users');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('group_bets', function (Blueprint $table) {
            $table->dropForeign(['id_tournament']);
            $table->dropForeign(['id_user_admin']);
            $table->dropForeign(['id_user_group_bet']);
        });

        Schema::dropIfExists('group_bets');
    }
}