<?php

use App\Http\Controllers\KirimEmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/formemail', [KirimEmailController::class, 'index'])->name('kirim.mail');
    Route::post('/kirim', [KirimEmailController::class, 'kirim']);
    Route::get('/todolist', [TodoController::class, 'index'])->name('todo');
    Route::post('/new-todo', [TodoController::class, 'store'])->name('create.todo');
    Route::put('/update-todo/{id}', [TodoController::class, 'update'])->name('update.todo');
    Route::delete('/delete-todo/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
});


require __DIR__ . '/auth.php';
