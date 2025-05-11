<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $games = $user->games()->get();
        $allGames = Game::all();

        // Fetch user reviews for games
        $userReviews = \App\Models\UserGameReview::where('user_id', $user->id)->get()->keyBy('game_id');

        return view('my_space', compact('games', 'allGames', 'userReviews'));
    }

    public function deleteGame($id)
    {
        $user = Auth::user();

        // Authorization check: only admin can remove games from user
        if (!$user->can('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $game = $user->games()->where('id', $id)->first();

        if ($game) {
            // Instead of deleting, set user_id to null to remove association
            $game->user_id = null;
            $game->save();
            return redirect()->route('my_space')->with('success', 'Game removed from your list successfully.');
        } else {
            return redirect()->route('my_space')->with('error', 'Game not found in your list.');
        }
    }

    public function reviewGame(Request $request, $gameId)
    {
        $user = Auth::user();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = \App\Models\UserGameReview::updateOrCreate(
            ['user_id' => $user->id, 'game_id' => $gameId],
            ['rating' => $request->input('rating')]
        );

        return redirect()->route('my_space')->with('success', 'Your review has been submitted.');
    }
}
