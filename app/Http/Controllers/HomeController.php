<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all games
        $games = Game::all();

        // Fetch latest news, for example latest 5 news articles
        $news = News::orderBy('created_at', 'desc')->take(5)->get();

        // Return the homepage view with games and news data
        return view('homepage', compact('games', 'news'));
    }
}
