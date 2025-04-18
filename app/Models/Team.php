<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tournament',
        'name',
        'team_shield',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'id_tournament');
    }
}