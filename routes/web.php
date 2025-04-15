<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\AdminController;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

//Adding Games
Route::post('/add-game', [\App\Http\Controllers\GameController::class, 'addGame'])->middleware('auth')->name('add.game');

// Admin Panel Routes
Route::post('/admin/add-game', [\App\Http\Controllers\AdminController::class, 'addGame'])->middleware('auth')->name('admin.add.game');
Route::delete('/admin/delete-game/{id}', [\App\Http\Controllers\AdminController::class, 'deleteGame'])->middleware('auth')->name('admin.delete.game');
Route::post('/admin/add-news', [\App\Http\Controllers\AdminController::class, 'addNewsArticle'])->middleware('auth')->name('admin.add.news');

