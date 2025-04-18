<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_schedule',
        'score_team1',
        'score_team2',
        'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function schedule()
    {
        return $this->belongsTo(ScheduleResult::class, 'id_schedule');
    }
}