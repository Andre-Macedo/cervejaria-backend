<?php

namespace App\Models\GameApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\GameApp\QuestionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'option_id',
        'difficulty',
    ];

    protected $casts = [
        'difficulty' => 'string',
    ];

    public function correctOption(): BelongsTo
    {
        return $this->belongsTo(Option::class, 'option_id');
    }

}
