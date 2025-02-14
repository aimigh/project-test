<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('todo/store', [TodoController::class, 'store'])->name('todo.store');
Route::get('todo/done/{id}', [TodoController::class, 'edit'])->name('todo.done');
Route::get('todo/revert/{idTodo}', [TodoController::class, 'revert'])->name('todo.revert');
Route::get('todo/delete/{idItem}', [TodoController::class, 'destroy'])->name('todo.delete');


