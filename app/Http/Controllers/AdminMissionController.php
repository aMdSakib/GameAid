<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Mission;
use Illuminate\Http\Request;

class AdminMissionController extends Controller
{
    public function index($gameId)
    {
        $game = Game::findOrFail($gameId);
        $missions = $game->missions()->orderBy('order')->get();

        return view('admin.missions.index', compact('game', 'missions'));
    }

    public function create($gameId)
    {
        $game = Game::findOrFail($gameId);
        return view('admin.missions.create', compact('game'));
    }

    public function store(Request $request, $gameId)
    {
        $game = Game::findOrFail($gameId);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:main,side',
            'order' => 'required|integer',
        ]);

        $game->missions()->create($request->only('name', 'type', 'order'));

        return redirect()->route('admin.missions.index', $gameId)->with('success', 'Mission created successfully.');
    }

    public function edit($gameId, $missionId)
    {
        $game = Game::findOrFail($gameId);
        $mission = Mission::findOrFail($missionId);

        return view('admin.missions.edit', compact('game', 'mission'));
    }

    public function update(Request $request, $gameId, $missionId)
    {
        $mission = Mission::findOrFail($missionId);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:main,side',
            'order' => 'required|integer',
        ]);

        $mission->update($request->only('name', 'type', 'order'));

        return redirect()->route('admin.missions.index', $gameId)->with('success', 'Mission updated successfully.');
    }

    public function destroy($gameId, $missionId)
    {
        $mission = Mission::findOrFail($missionId);
        $mission->delete();

        return redirect()->route('admin.missions.index', $gameId)->with('success', 'Mission deleted successfully.');
    }
}
