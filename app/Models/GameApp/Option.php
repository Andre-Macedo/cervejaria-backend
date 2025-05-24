<?php

namespace App\Models\GameApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    /** @use HasFactory<\Database\Factories\GameApp\OptionFactory> */
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'label',
        'value',
    ];

}
