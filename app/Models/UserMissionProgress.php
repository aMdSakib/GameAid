<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMissionProgress extends Model
{
    use HasFactory;

    protected $table = 'user_mission_progress';

    protected $fillable = [
        'user_id',
        'mission_id',
        'completed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
