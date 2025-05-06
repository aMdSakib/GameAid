<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games'; // Specify the table name if it differs from the model name

    protected $fillable = [
        'name',
        'image_path',
    ];

<<<<<<< Updated upstream
    public $timestamps = true; // Enable automatic handling of created_at and updated_at
=======
    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    public function userGameReviews()
    {
        return $this->hasMany(UserGameReview::class);
    }
>>>>>>> Stashed changes
}
