<?php

namespace App\Models\GameApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    /** @use HasFactory<\Database\Factories\GameApp\PlayerFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'players';
    protected $fillable = ['name'];

}
