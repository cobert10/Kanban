<?php

use Inertia\Inertia;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CardController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CardContainerController;

// test out vuedraggable
Route::get('/vuedraggable', function() {
    return Inertia::render('Test');
});


Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('/boards', [BoardController::class, 'index'])->name('boards');
    Route::post('/boards', [BoardController::class, 'store'])->name('boards.store');

    Route::get('/boards/{board}', [BoardController::class, 'show'])->name('boards.show');
    Route::put('/boards/{board}', [BoardController::class, 'update'])->name('boards.update');

    Route::post('/card_containers', [CardContainerController::class, 'store'])->name('card_container.store');
    Route::put('/card_containers/{card_container}', [CardContainerController::class, 'update'])->name('card_container_header.update');
    // Route::put('/card_containers/{card_container}/move', [CardContainerController::class, 'move'])->name('card_container.move');
    Route::delete('/card_containers/{card_container}', [CardContainerController::class, 'delete'])->name('card_container.delete');

    Route::post('/cards', [CardController::class, 'store'])->name('card.store');
    Route::put('/cards/{card}', [CardController::class, 'update'])->name('card.update');
    Route::put('/cards/{card}/move', [CardController::class, 'move'])->name('card.move');
    Route::delete('/cards/{card}/', [CardController::class, 'delete'])->name('card.delete');
});
 
Route::get('/', function () {
    return Inertia::render('SignIn', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
