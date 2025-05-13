<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Experience;

class ProfileController extends Controller
{
    public function choosePlan()
    {
        return view('choose_plan');
    }

    public function submitPlan(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:basic,premium',
        ]);

        $user = Auth::user();

        if ($request->plan === 'premium') {
            $user->premium_user = true;
        } else {
            $user->premium_user = false;
        }

        $user->save();

        return redirect()->route('my_space')->with('success', 'Your plan has been updated.');
    }

    public function games()
    {
        $user = Auth::user();
        $games = $user->games()->with('missions')->get();

        $progressData = [];

        foreach ($games as $game) {
            $missions = $game->missions;
            $missionIds = $missions->pluck('id');

            $completedCount = \App\Models\UserMissionProgress::where('user_id', $user->id)
                ->whereIn('mission_id', $missionIds)
                ->where('completed', true)
                ->count();

            $totalMissions = $missions->count();
            $completionPercentage = $totalMissions > 0 ? round(($completedCount / $totalMissions) * 100) : 0;

            $progressData[$game->id] = $completionPercentage;
        }

        return view('profile.games', compact('games', 'progressData'));
    }

    public function shareProgress(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'content' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        $experience = new Experience();
        $experience->user_id = $user->id;
        $experience->game_id = $request->input('game_id');
        $experience->content = "My progress for " . $request->input('content');
        $experience->type = 'progress';
        $experience->approved = true; // or false if moderation is needed
        $experience->save();

        return redirect()->route('community.index')->with('success', 'Progress shared successfully.');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $emailChanged = $request->email !== $user->email;

        $user->name = $request->name;
        $user->email = $request->email;

        if ($emailChanged) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect('/profile')->with('success', 'Profile updated successfully.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => 'required',
        ]);

        if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return redirect('/profile')->withErrors(['userDeletion.password' => 'The provided password is incorrect.']);
        }

        Auth::logout();

        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
