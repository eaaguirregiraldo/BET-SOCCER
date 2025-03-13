<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociatedImagesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('associated_images'); // Eliminar la tabla si ya existe

        Schema::create('associated_images', function (Blueprint $table) {
            $table->id();
            $table->longText('image');
            $table->foreignId('id_stadium')->constrained('stadiums');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('associated_images', function (Blueprint $table) {
            $table->dropForeign(['id_stadium']);
        });

        Schema::dropIfExists('associated_images');
    }
}