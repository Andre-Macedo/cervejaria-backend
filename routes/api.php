<?php

use App\Models\GameApp\Option;
use App\Models\GameApp\Player;
use App\Models\GameApp\PlayerScore;
use App\Models\GameApp\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/questions', function () {
    $questions = Question::with('correctOption')->get();
    $options = Option::all();
    return response()->json([
        'questions' => $questions,
        'options' => $options,
    ]);
})->name('questions');

Route::post('/answers', function (Request $request) {

    $validated = $request->validate([
        'question_id' => 'required|exists:questions,id',
        'option_value' => 'required|string',
    ]);

    $question = Question::with('correctOption')->find($validated['question_id']);
    $isCorrect = $question->correctOption->value === $validated['option_value'];
    $baseScore = 10;
    $multiplier = match ($question->difficulty) {
        'easy' => 1,
        'medium' => 2,
        'hard' => 3,
    };
    $points = $isCorrect ? $baseScore * $multiplier : 0;

    return response()->json([
        'is_correct' => $isCorrect,
        'points' => $points,
        'correct_option' => $question->correctOption->value,
    ]);
})->name('answers');

Route::post('/players', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $player = Player::create($validated);

    return response()->json(['player_id' => $player->id, 'name' => $player->name], 201);
})->name('players.store');

Route::post('/scores', function (Request $request) {
    $validated = $request->validate([
        'player_id' => 'required|exists:players,id',
        'score' => 'required|integer',
    ]);

    $score = PlayerScore::create($validated);

    return response()->json(['message' => 'Score saved', 'data' => $score], 201);
})->name('scores.store');

Route::get('/scores', function (Request $request) {
    $limit = $request->query('limit', 15); // Default to 15 if not provided
    $offset = $request->query('offset', 0); // Default to 0 if not provided

    $scores = PlayerScore::select('player_scores.player_id', 'players.name as player_name', 'player_scores.score', 'player_scores.created_at')
        ->join('players', 'player_scores.player_id', '=', 'players.id')
        ->whereIn('player_scores.id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('player_scores')
                ->groupBy('player_id')
                ->whereIn('score', function ($subQuery) {
                    $subQuery->select(DB::raw('MAX(score)'))
                        ->from('player_scores')
                        ->groupBy('player_id');
                });
        })
        ->orderBy('player_scores.score', 'desc')
        ->orderBy('player_scores.created_at', 'asc')
        ->skip($offset) // Apply offset
        ->take($limit) // Apply limit
        ->get()
        ->map(function ($score, $index) {
            return [
                'player_id' => $score->player_id,
                'player_name' => $score->player_name,
                'score' => $score->score,
                'rank' => $index + 1,
                'created_at' => $score->created_at,
            ];
        });
    return response()->json($scores);
})->name('scores.index');
