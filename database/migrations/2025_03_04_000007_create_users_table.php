<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    public function up()
    {
        // Eliminar tablas si existen para evitar conflictos
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('birthday'); // Campo obligatorio
            $table->string('phone_number'); // Campo obligatorio
            $table->rememberToken();
            $table->timestamps();
            $table->enum('role', ['Admin_Group_Bed', 'Admin', 'Bet_User']);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down()
    {
        // Verificar si las tablas existen antes de intentar eliminarlas
        if (Schema::hasTable('sessions')) {
            // Verificar si existe la restricción de clave foránea antes de intentar eliminarla
            try {
                // Intentar eliminar directamente las tablas sin usar dropForeign
                Schema::dropIfExists('sessions');
            } catch (\Exception $e) {
                // Si falla, continuar con el proceso
            }
        }
        
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
}