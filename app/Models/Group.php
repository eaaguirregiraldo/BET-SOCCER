<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'id_team',
        'GF',
        'GC',
        'DG',
        'Points',
        'PJ',
        'PG',
        'PP',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'id_team');
    }
}