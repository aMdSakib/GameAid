<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< Updated upstream
=======
use App\Models\Game;
use App\Models\News;
use App\Models\Experience;
use Illuminate\Support\Facades\Log;
>>>>>>> Stashed changes

class AdminController extends Controller
{
    public function AdminDashboard(){
<<<<<<< Updated upstream

        return view('admin.admin_dashboard');

    } //End Method
=======
        $games = Game::all();
        $news = News::all();
        $unapprovedExperiences = Experience::where('approved', false)->get();
        $unapprovedAnswers = \App\Models\Answer::where('approved', false)
            ->whereHas('experience', function ($query) {
                $query->where('type', 'question');
            })
            ->get();
        $unapprovedCount = $unapprovedExperiences->count() + $unapprovedAnswers->count();
        return view('admin.admin_dashboard', compact('games', 'news', 'unapprovedExperiences', 'unapprovedAnswers', 'unapprovedCount'));
    } //End Method

    public function addGame(Request $request)
    {
        Log::info('addGame Request Data:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'characters' => 'nullable|string',
            'game_details' => 'nullable|string',
        ]);

        $game = new Game();
        $game->name = $request->name;
        $game->description = $request->description;
        $game->characters = $request->characters;
        $game->game_details = $request->game_details;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('Images'), $imageName);
            $game->image_path = $imageName;
        } else {
            $game->image_path = 'no-image-available.png';
        }

        $game->user_id = auth()->id();

        try {
            $game->save();
            Log::info('Game added successfully: ', $game->toArray());
        } catch (\Exception $e) {
            Log::error('Failed to add game: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add game.');
        }

        return redirect()->route('admin.dashboard')->with('success', 'Game added successfully!');
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
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('Images'), $imageName);
            $news->image_path = $imageName;
        } else {
            $news->image_path = 'no-image-available.png';
        }

        $news->link = $request->link;

        try {
            $news->save();
            Log::info('News article added successfully: ', $news->toArray());
        } catch (\Exception $e) {
            Log::error('Failed to add news article: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add news article.');
        }

        return redirect()->route('admin.dashboard')->with('success', 'News article added successfully!');
    }

    public function deleteNewsArticle($id)
    {
        $news = News::find($id);
        if (!$news) {
            return redirect()->back()->with('error', 'News article not found.');
        }

        try {
            $news->delete();
            Log::info('News article deleted successfully: ', ['id' => $id]);
        } catch (\Exception $e) {
            Log::error('Failed to delete news article: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete news article.');
        }

        return redirect()->back()->with('success', 'News article deleted successfully!');
    }

    public function approveExperience($id)
    {
        $experience = Experience::find($id);
        if (!$experience) {
            return redirect()->back()->with('error', 'Experience not found.');
        }
        $experience->approved = true;
        $experience->save();

        return redirect()->back()->with('success', 'Experience approved successfully.');
    }

    public function rejectExperience($id)
    {
        $experience = Experience::find($id);
        if (!$experience) {
            return redirect()->back()->with('error', 'Experience not found.');
        }
        $experience->delete();

        return redirect()->back()->with('success', 'Experience rejected and deleted successfully.');
    }

    public function approveAnswer($id)
    {
        $answer = \App\Models\Answer::find($id);
        if (!$answer) {
            return redirect()->back()->with('error', 'Answer not found.');
        }
        $answer->approved = true;
        $answer->save();

        return redirect()->back()->with('success', 'Answer approved successfully.');
    }

    public function rejectAnswer($id)
    {
        $answer = \App\Models\Answer::find($id);
        if (!$answer) {
            return redirect()->back()->with('error', 'Answer not found.');
        }
        $answer->delete();

        return redirect()->back()->with('success', 'Answer rejected and deleted successfully.');
    }

    public function updateGameImage(Request $request, $id)
    {
        $game = Game::find($id);
        if (!$game) {
            return redirect()->back()->with('error', 'Game not found.');
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('Images'), $imageName);
            $game->image_path = $imageName;
            $game->save();
            return redirect()->back()->with('success', 'Game image updated successfully.');
        }

        return redirect()->back()->with('error', 'No image uploaded.');
    }

    public function updateGameDetails(Request $request, $id)
    {
        $game = Game::find($id);
        if (!$game) {
            return redirect()->back()->with('error', 'Game not found.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'characters' => 'nullable|string',
            'game_details' => 'nullable|string',
        ]);

        $game->name = $request->input('name');
        $game->description = $request->input('description');
        $game->characters = $request->input('characters');
        $game->game_details = $request->input('game_details');

        try {
            $game->save();
            return redirect()->route('admin.edit.game', $id)->with('success', 'Game details updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.edit.game', $id)->with('error', 'Failed to update game details.');
        }
    }

    public function editGame($id)
    {
        $game = Game::find($id);
        if (!$game) {
            return redirect()->route('admin.dashboard')->with('error', 'Game not found.');
        }
        return view('admin.edit_game', compact('game'));
    }
>>>>>>> Stashed changes
}
