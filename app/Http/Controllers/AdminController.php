<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\News;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function AdminDashboard(){
        $games = Game::all();
        $news = News::all();
        return view('admin.admin_dashboard', compact('games', 'news'));
    } //End Method

    public function addGame(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $game = new Game();
        $game->name = $request->name;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $game->image_path = 'storage/' . $imagePath;
        } else {
            $game->image_path = 'Images/no-image-available.png';
        }

        $game->user_id = auth()->id();

        try {
            $game->save();
            Log::info('Game added successfully: ', $game->toArray());
        } catch (\Exception $e) {
            Log::error('Failed to add game: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add game.');
        }

        return redirect()->back()->with('success', 'Game added successfully!');
    }

    public function deleteGame($id)
    {
        $game = Game::find($id);
        if (!$game) {
            return redirect()->back()->with('error', 'Game not found.');
        }

        try {
            $game->delete();
            Log::info('Game deleted successfully: ', ['id' => $id]);
        } catch (\Exception $e) {
            Log::error('Failed to delete game: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete game.');
        }

        return redirect()->back()->with('success', 'Game deleted successfully!');
    }

    public function addNewsArticle(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|string|max:255',
        ]);

        $news = new News();
        $news->title = $request->title;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $news->image_path = 'storage/' . $imagePath;
        } else {
            $news->image_path = 'Images/no-image-available.png';
        }

        $news->link = $request->link;

        try {
            $news->save();
            Log::info('News article added successfully: ', $news->toArray());
        } catch (\Exception $e) {
            Log::error('Failed to add news article: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add news article.');
        }

        return redirect()->back()->with('success', 'News article added successfully!');
    }
}
