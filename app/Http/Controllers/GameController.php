<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    // Method to store a new game
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_path' => 'required|string|max:255',
        ]);

        $game = new Game();
        $game->name = $request->name;
        $game->image_path = $request->image_path;
        $game->save();

        return response()->json(['success' => true, 'game' => $game]);
    }

    // Method to delete a game
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return response()->json(['success' => true]);
    }
}