<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





Route::middleware('auth')->group(function () {
Route::get('/main', [\App\Http\Controllers\Main\Main\IndexController::class, 'index'])->name('main.index');
Route::get('/tournament', [\App\Http\Controllers\Main\Tournament\TournamentController::class, 'index'])->name('tournament.index');
Route::get('/teams', [\App\Http\Controllers\Main\Team\TeamController::class, 'index'])->name('team.index');
Route::get('/teams/{team}', [\App\Http\Controllers\Main\Team\TeamController::class, 'show'])->name('team.show');
Route::resource('/players', \App\Http\Controllers\Main\Player\PlayerController::class);

});






Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'admin.check'],
], function () {
    Route::get('/', [\App\Http\Controllers\Admin\Main\IndexController::class, 'index'])->name('main.index');

    Route::resource('/players', \App\Http\Controllers\Admin\Player\PlayerController::class);
    Route::resource('/teams', \App\Http\Controllers\Admin\Team\TeamController::class);
    Route::resource('/games', \App\Http\Controllers\Admin\Game\GameController::class);
    Route::get('/games/{game}/edit-details', [\App\Http\Controllers\Admin\Game\GameController::class, 'editDetails'])
        ->name('games.editDetails');
    Route::patch('/games/{game}/update-details', [\App\Http\Controllers\Admin\Game\GameController::class, 'updateDetails'])
        ->name('games.updateDetails');

    Route::resource('/users', \App\Http\Controllers\Admin\User\UserController::class);
});

require __DIR__ . '/auth.php';
