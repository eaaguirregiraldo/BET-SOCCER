<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('groups'); // Eliminar la tabla si ya existe

        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('id_team')->constrained('teams');
            $table->integer('GF')->default(0);
            $table->integer('GC')->default(0);
            $table->integer('DG')->default(0);
            $table->integer('Points')->default(0);
            $table->integer('PJ')->default(0);
            $table->integer('PG')->default(0);
            $table->integer('PP')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}