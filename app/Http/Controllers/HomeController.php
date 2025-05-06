<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\News;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch games filtered by search query if provided
        if ($search) {
            $games = Game::where('name', 'like', '%' . $search . '%')->get();
        } else {
<<<<<<< Updated upstream
            $games = Game::orderBy('created_at', 'desc')->take(3)->get();
=======
            // Fetch 4 latest games with average review stars
            $games = Game::withAvg('userGameReviews', 'rating')
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
>>>>>>> Stashed changes
        }

        // Fetch latest news, for example latest 5 news articles
        $news = News::orderBy('created_at', 'desc')->take(5)->get();

        // Return the homepage view with games and news data
        return view('homepage', compact('games', 'news', 'search'));
    }
}
