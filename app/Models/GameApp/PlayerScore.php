<?php

namespace App\Models\GameApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerScore extends Model
{
    /** @use HasFactory<\Database\Factories\GameApp\PlayerScoreFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'player_scores';
    protected $fillable = [
        'player_id',
        'score',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
