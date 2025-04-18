<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'characteristics',
    ];

    protected $table = 'stadiums'; // Asegúrate de que el modelo use la tabla correcta
}