<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    public function up()
    {
       
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('amount_teams');
            $table->enum('first_phase_groups', ['S', 'N']);
            $table->timestamps();
        });
    }

    public function down()
    {        
        Schema::dropIfExists('tournaments');
    }
}