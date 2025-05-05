<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience_id',
        'user_id',
        'content',
        'likes',
        'dislikes',
        'approved',
    ];

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userLikes()
    {
        return $this->belongsToMany(\App\Models\User::class, 'answer_user_likes')
            ->withPivot('type')
            ->withTimestamps();
    }
}
