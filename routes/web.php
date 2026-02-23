<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PollController::class, 'index'])->name('dashboard');
    Route::get('/polls/create', [PollController::class, 'create'])->name('polls.create');
    Route::post('/polls', [PollController::class, 'store'])->name('polls.store');
    Route::get('/polls/{id}', [PollController::class, 'show'])->name('polls.show');
});

Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth')->name('home');
