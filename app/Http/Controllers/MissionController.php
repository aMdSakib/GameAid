<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Mission;
use App\Models\UserMissionProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    public function index($gameId)
    {
        $user = Auth::user();
        $game = Game::findOrFail($gameId);
        $missions = $game->missions()->orderBy('order')->get();

        // Separate missions by type
        $mainMissions = $missions->where('type', 'main');
        $sideMissions = $missions->where('type', 'side');

        // Get user's mission progress for this game's missions
        $progress = UserMissionProgress::where('user_id', $user->id)
            ->whereIn('mission_id', $missions->pluck('id'))
            ->pluck('completed', 'mission_id');

        // Calculate completion percentage
        $totalMissions = $missions->count();
        $completedMissions = $progress->filter(function ($completed) {
            return $completed;
        })->count();

        $completionPercentage = $totalMissions > 0 ? round(($completedMissions / $totalMissions) * 100) : 0;

        return view('missions.index', compact('game', 'mainMissions', 'sideMissions', 'progress', 'completionPercentage'));
    }

    public function toggleCompletion(Request $request, $missionId)
    {
        $user = Auth::user();
        $mission = Mission::findOrFail($missionId);

        $progress = UserMissionProgress::firstOrNew([
            'user_id' => $user->id,
            'mission_id' => $mission->id,
        ]);

        $progress->completed = !$progress->completed;
        $progress->save();

        return response()->json(['completed' => $progress->completed]);
    }

    public function getUserGameProgress()
    {
        $user = auth()->user();
        $games = $user->games()->with('missions')->get();

        $progressData = [];

        foreach ($games as $game) {
            $missions = $game->missions;
            $missionIds = $missions->pluck('id');

            $completedCount = UserMissionProgress::where('user_id', $user->id)
                ->whereIn('mission_id', $missionIds)
                ->where('completed', true)
                ->count();

            $totalMissions = $missions->count();
            $completionPercentage = $totalMissions > 0 ? round(($completedCount / $totalMissions) * 100) : 0;

            $progressData[$game->id] = $completionPercentage;
        }

        return response()->json($progressData);
    }
}
