<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

<<<<<<< Updated upstream
=======
use App\Models\Report;

>>>>>>> Stashed changes
class ExperienceController extends Controller
{
    public function index()
    {
        // Fetch all approved experiences with related user, game, and answers with users
        $experiences = Experience::with(['user', 'game', 'answers.user'])
            ->where('approved', true)
            ->where('type', 'experience')
            ->orderBy('created_at', 'desc')
            ->get();

<<<<<<< Updated upstream
=======
        // Fetch all approved progress posts with related user, game, and answers with users
        $progresses = Experience::with(['user', 'game', 'answers.user'])
            ->where('approved', true)
            ->where('type', 'progress')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate mission completion percentages for each progress post
        $completionPercentages = [];

        // Collect unique user-game pairs from progress posts
        $userGamePairs = $progresses->map(function ($progress) {
            return ['user_id' => $progress->user_id, 'game_id' => $progress->game_id];
        })->unique();

        foreach ($userGamePairs as $pair) {
            $userId = $pair['user_id'];
            $gameId = $pair['game_id'];

            // Get missions for the game
            $missions = \App\Models\Mission::where('game_id', $gameId)->get();
            $missionIds = $missions->pluck('id');

            // Count completed missions for the user
            $completedCount = \App\Models\UserMissionProgress::where('user_id', $userId)
                ->whereIn('mission_id', $missionIds)
                ->where('completed', true)
                ->count();

            $totalMissions = $missions->count();
            $completionPercentage = $totalMissions > 0 ? round(($completedCount / $totalMissions) * 100) : 0;

            // Store completion percentage keyed by user_id and game_id
            $completionPercentages[$userId . '_' . $gameId] = $completionPercentage;
        }

        // Map completion percentages to each progress post by experience id
        $progressCompletionMap = [];
        foreach ($progresses as $progress) {
            $key = $progress->user_id . '_' . $progress->game_id;
            $progressCompletionMap[$progress->id] = $completionPercentages[$key] ?? 0;
        }

>>>>>>> Stashed changes
        // Fetch all approved questions with related user, game, and answers with users
        $questions = Experience::with(['user', 'game', 'answers.user'])
            ->where('approved', true)
            ->where('type', 'question')
            ->orderBy('created_at', 'desc')
            ->get();

        $games = \App\Models\Game::all();

<<<<<<< Updated upstream
        return view('community.index', compact('experiences', 'questions', 'games'));
=======
        return view('community.index', compact('experiences', 'progresses', 'questions', 'games', 'progressCompletionMap'));
    }

    public function showReportForm($experienceId)
    {
        $experience = Experience::findOrFail($experienceId);
        return view('community.report', compact('experience'));
    }

    public function submitReport(Request $request, $experienceId)
    {
        $request->validate([
            'report_text' => 'required|string|max:1000',
        ]);

        $report = new Report();
        $report->experience_id = $experienceId;
        $report->user_id = auth()->id();
        $report->report_text = $request->report_text;
        $report->save();

        return redirect()->route('community.index')->with('success', 'Report submitted successfully.');
>>>>>>> Stashed changes
    }

    public function create(Request $request)
    {
        $games = \App\Models\Game::all();
        return view('community.create', compact('games'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'content' => 'required|string|max:1000',
            'type' => 'required|in:experience,question',
        ]);

        $post = new Experience();
        $post->user_id = Auth::id();
        $post->game_id = $request->game_id;
        $post->content = $request->content;
        $post->type = $request->type;
<<<<<<< Updated upstream
        $post->approved = false;
=======
        $post->approved = true;
>>>>>>> Stashed changes
        $post->likes = 0;
        $post->dislikes = 0;
        $post->save();

<<<<<<< Updated upstream
        return redirect()->route('community.index')->with('success', 'Your post has been submitted for approval.');
=======
        return redirect()->route('community.index')->with('success', 'Your post has been posted successfully.');
>>>>>>> Stashed changes
    }

    public function storeAnswer(Request $request, $experienceId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $answer = new \App\Models\Answer();
        $answer->experience_id = $experienceId;
        $answer->user_id = Auth::id();
        $answer->content = $request->content;
        $answer->likes = 0;
        $answer->dislikes = 0;
        $answer->save();

        return redirect()->back()->with('success', 'Your reply has been posted.');
    }

    public function likePost($id)
    {
        $post = Experience::find($id);
        $user = auth()->user();
        if (!$post || !$user) {
            return response()->json(['error' => 'Post or user not found'], 404);
        }

        $existing = $post->userLikes()->where('user_id', $user->id)->first();

        if ($existing) {
            if ($existing->pivot->type === 'like') {
                // Remove like
                $post->userLikes()->detach($user->id);
                $post->decrement('likes');
            } else {
                // Switch dislike to like
                $post->userLikes()->updateExistingPivot($user->id, ['type' => 'like']);
                $post->increment('likes');
                $post->decrement('dislikes');
            }
        } else {
            // Add like
            $post->userLikes()->attach($user->id, ['type' => 'like']);
            $post->increment('likes');
        }

        return response()->json(['likes' => $post->likes, 'dislikes' => $post->dislikes]);
    }

    public function dislikePost($id)
    {
        $post = Experience::find($id);
        $user = auth()->user();
        if (!$post || !$user) {
            return response()->json(['error' => 'Post or user not found'], 404);
        }

        $existing = $post->userLikes()->where('user_id', $user->id)->first();

        if ($existing) {
            if ($existing->pivot->type === 'dislike') {
                // Remove dislike
                $post->userLikes()->detach($user->id);
                $post->decrement('dislikes');
            } else {
                // Switch like to dislike
                $post->userLikes()->updateExistingPivot($user->id, ['type' => 'dislike']);
                $post->increment('dislikes');
                $post->decrement('likes');
            }
        } else {
            // Add dislike
            $post->userLikes()->attach($user->id, ['type' => 'dislike']);
            $post->increment('dislikes');
        }

        return response()->json(['likes' => $post->likes, 'dislikes' => $post->dislikes]);
    }

    public function likeAnswer($id)
    {
        $answer = \App\Models\Answer::find($id);
        $user = auth()->user();
        if (!$answer || !$user) {
            return response()->json(['error' => 'Answer or user not found'], 404);
        }

        $existing = $answer->userLikes()->where('user_id', $user->id)->first();

        if ($existing) {
            if ($existing->pivot->type === 'like') {
                // Remove like
                $answer->userLikes()->detach($user->id);
                $answer->decrement('likes');
            } else {
                // Switch dislike to like
                $answer->userLikes()->updateExistingPivot($user->id, ['type' => 'like']);
                $answer->increment('likes');
                $answer->decrement('dislikes');
            }
        } else {
            // Add like
            $answer->userLikes()->attach($user->id, ['type' => 'like']);
            $answer->increment('likes');
        }

        return response()->json(['likes' => $answer->likes, 'dislikes' => $answer->dislikes]);
    }

    public function dislikeAnswer($id)
    {
        $answer = \App\Models\Answer::find($id);
        $user = auth()->user();
        if (!$answer || !$user) {
            return response()->json(['error' => 'Answer or user not found'], 404);
        }

        $existing = $answer->userLikes()->where('user_id', $user->id)->first();

        if ($existing) {
            if ($existing->pivot->type === 'dislike') {
                // Remove dislike
                $answer->userLikes()->detach($user->id);
                $answer->decrement('dislikes');
            } else {
                // Switch like to dislike
                $answer->userLikes()->updateExistingPivot($user->id, ['type' => 'dislike']);
                $answer->increment('dislikes');
                $answer->decrement('likes');
            }
        } else {
            // Add dislike
            $answer->userLikes()->attach($user->id, ['type' => 'dislike']);
            $answer->increment('dislikes');
        }

        return response()->json(['likes' => $answer->likes, 'dislikes' => $answer->dislikes]);
    }
}
