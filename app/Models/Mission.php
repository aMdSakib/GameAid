<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'name',
        'type',
        'order',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
