<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
    Route::get('/todo/{id}', [TodoController::class, 'getTodoList'])->name('todo-list.index');
    Route::patch('/todo/{todo}', [TodoController::class, 'update'])->name('todo-list.update');
    Route::delete('/todo/{todo}', [TodoController::class, 'delete'])->name('todo-list.destroy');
});

require __DIR__.'/auth.php';
