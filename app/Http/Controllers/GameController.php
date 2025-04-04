<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game; // Import the Game model
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    public function addGame(Request $request)
    {
        // Log the incoming request data for debugging
        Log::info('Adding game with request data: ', $request->all());
        
        // Validate the request
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'image_path' => 'required|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ', $e->errors());
            return redirect()->back()->with('error', 'Validation failed. Please check your input.');
        }
    
        // Create a new game instance and associate it with the authenticated user
        $game = new Game();
        $game->name = $request->name;
        $game->image_path = $request->image_path;
        $game->user_id = auth()->id(); // Set the user_id to the authenticated user's ID
        
        // Attempt to save the game and log any errors
        try {
            $game->save();
            Log::info('Game added successfully: ', $game->toArray());
        } catch (\Exception $e) {
            Log::error('Failed to add game: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add game.');
        }
        
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Game added successfully!');
    }
}
