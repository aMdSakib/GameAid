<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\AdminController;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/games', [ProfileController::class, 'games'])->name('profile.games');
});
Route::get('/game/witcher3', function () {
    return view('games.witcher3');
})->name('game.witcher3');

Route::get('/game/pokemonza', function () {
    return view('games.pokemonza');
})->name('game.pokemonza');

Route::get('/game/gta6', function () {
    return view('games.gta6');
})->name('game.gta6');

Route::get('/game/rdr2', function () {
    return view('games.rdr2');
})->name('game.rdr2');

Route::get('/game/ac_black_flag', function () {
    return view('games.ac_black_flag');
})->name('game.ac_black_flag');

Route::get('/game/ghost_of_tsushima', function () {
    return view('games.ghost_of_tsushima');
})->name('game.ghost_of_tsushima');

Route::get('/game/zelda_tears_of_kingdom', function () {
    return view('games.zelda_tears_of_kingdom');
})->name('game.zelda_tears_of_kingdom');
require __DIR__.'/auth.php';

// Community page routes
use App\Http\Controllers\ExperienceController;

Route::middleware('auth')->group(function () {
    Route::get('/community', [ExperienceController::class, 'index'])->name('community.index');
    Route::post('/community', [ExperienceController::class, 'store'])->name('community.store');
    Route::get('/community/create', [ExperienceController::class, 'create'])->name('community.create');

    Route::post('/community/{experience}/answer', [ExperienceController::class, 'storeAnswer'])->name('community.answer.store');

    // Added routes for like and dislike buttons to work
    Route::post('/community/like-post/{id}', [ExperienceController::class, 'likePost'])->name('community.like.post');
    Route::post('/community/dislike-post/{id}', [ExperienceController::class, 'dislikePost'])->name('community.dislike.post');

    Route::post('/community/like-answer/{id}', [ExperienceController::class, 'likeAnswer'])->name('community.like.answer');
    Route::post('/community/dislike-answer/{id}', [ExperienceController::class, 'dislikeAnswer'])->name('community.dislike.answer');
});

Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->middleware('auth')->name('admin.dashboard');

Route::post('/admin/approve-experience/{id}', [AdminController::class, 'approveExperience'])->middleware('auth')->name('admin.approve.experience');
Route::delete('/admin/reject-experience/{id}', [AdminController::class, 'rejectExperience'])->middleware('auth')->name('admin.reject.experience');

//Adding Games
Route::post('/add-game', [\App\Http\Controllers\GameController::class, 'addGame'])->middleware('auth')->name('add.game');

// Admin Panel Routes
Route::post('/admin/add-game', [\App\Http\Controllers\AdminController::class, 'addGame'])->middleware('auth')->name('admin.add.game');
Route::delete('/admin/delete-game/{id}', [\App\Http\Controllers\AdminController::class, 'deleteGame'])->middleware('auth')->name('admin.delete.game');
Route::post('/admin/add-news', [\App\Http\Controllers\AdminController::class, 'addNewsArticle'])->middleware('auth')->name('admin.add.news');

Route::delete('/admin/delete-news/{id}', [\App\Http\Controllers\AdminController::class, 'deleteNewsArticle'])->middleware('auth')->name('admin.delete.news');

Route::get('/games/{id}', [\App\Http\Controllers\GameController::class, 'show'])->name('games.show');

