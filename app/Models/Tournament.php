<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'amount_teams',
        'first_phase_groups',
    ];

    public function teams()
    {
        return $this->hasMany(Team::class, 'id_tournament');
    }
}