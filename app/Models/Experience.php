<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_id',
        'content',
        'type',
        'approved',
        'likes',
        'dislikes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function answers()
    {
        return $this->hasMany(\App\Models\Answer::class);
    }

    public function userLikes()
    {
        return $this->belongsToMany(\App\Models\User::class, 'experience_user_likes')
            ->withPivot('type')
            ->withTimestamps();
    }
}
