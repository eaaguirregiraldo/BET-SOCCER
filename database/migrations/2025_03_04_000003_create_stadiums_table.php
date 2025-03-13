<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadiumsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('stadiums'); // Eliminar la tabla si ya existe

        Schema::create('stadiums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('characteristics');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stadiums');
    }
}