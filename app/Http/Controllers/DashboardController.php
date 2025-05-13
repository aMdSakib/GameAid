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

        // Restrict access to premium users only with popup flag
        if (!$user->premium_user) {
            return redirect('/')->with('show_premium_popup', true);
        }

        $games = $user->games()->get();
        $allGames = Game::all();

        // Fetch user reviews for games
        $userReviews = \App\Models\UserGameReview::where('user_id', $user->id)->get()->keyBy('game_id');

        // Fetch user's community posts (experiences and questions)
        $myPosts = \App\Models\Experience::with('game')
            ->where('user_id', $user->id)
            ->where('approved', true)
            ->where('type', 'experience')
            ->orderBy('created_at', 'desc')
            ->get();

        $myQuestions = \App\Models\Experience::with('game')
            ->where('user_id', $user->id)
            ->where('approved', true)
            ->where('type', 'question')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my_space', compact('games', 'allGames', 'userReviews', 'myPosts', 'myQuestions'));
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
