<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game; // Import the Game model
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    public function addGame(Request $request)
    {
        // Validate the request
        $request->validate([
            'game_id' => 'required|integer|exists:games,id',
        ]);

        $user = auth()->user();
        $gameId = $request->input('game_id');

        // Find the game by id
        $game = Game::find($gameId);

        if (!$game) {
            return redirect()->back()->with('error', 'Selected game does not exist.');
        }

        // Check if the game is already assigned to the user
<<<<<<< Updated upstream
        if ($user->games()->where('id', $gameId)->exists()) {
            return redirect()->back()->with('error', 'You have already added this game.');
        }

        // Assign the game to the user by setting user_id
        $game->user_id = $user->id;

        try {
            $game->save();
=======
        if ($user->games()->where('games.id', $gameId)->exists()) {
            return redirect()->back()->with('error', 'You have already added this game.');
        }

        try {
            // Attach the game to the user via pivot table
            $user->games()->attach($gameId);
>>>>>>> Stashed changes
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add game.');
        }

        return redirect()->back()->with('success', 'Game added successfully!');
    }

    public function getLatestGameNews()
    {
        // Fetch the latest game news from your data source
        // This could be from a database or an external API
        $latestNews = [
            [
                'title' => 'Game News Title 1',
                'image' => 'path/to/image1.jpg',
                'link' => 'link/to/news1'
            ],
            [
                'title' => 'Game News Title 2',
                'image' => 'path/to/image2.jpg',
                'link' => 'link/to/news2'
            ],
            // Add more news items as needed
        ];

        return $latestNews;
    }

    public function listGames()
    {
        $games = Game::all();
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        return view('games.index', compact('games'));
=======
=======
>>>>>>> Stashed changes

        // Calculate average rating for each game
        $gameIds = $games->pluck('id')->toArray();
        $averageRatings = \App\Models\UserGameReview::whereIn('game_id', $gameIds)
            ->selectRaw('game_id, AVG(rating) as avg_rating')
            ->groupBy('game_id')
            ->pluck('avg_rating', 'game_id');

        return view('games.index', compact('games', 'averageRatings'));
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    }

    public function show($id)
    {
        $game = Game::find($id);

        if (!$game) {
            abort(404, 'Game not found');
        }

        return view('games.show', compact('game'));
    }
}
