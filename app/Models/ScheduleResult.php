<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_team_1',
        'id_team_2',
        'score_team1',
        'score_team2',
        'id_stadium',
        'date_time',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'id_team_1');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'id_team_2');
    }

    public function stadium()
    {
        return $this->belongsTo(Stadium::class, 'id_stadium');
    }
}