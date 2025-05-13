<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'user_id',
        'description',
        'characters',
        'game_details',
    ];

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    public function userGameReviews()
    {
        return $this->hasMany(UserGameReview::class);
    }
<<<<<<< Updated upstream
=======

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_game');
    }
>>>>>>> Stashed changes
}
