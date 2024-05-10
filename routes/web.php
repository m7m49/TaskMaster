<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile')->middleware('auth');
Route::patch('/updateProfile', [ProfileController::class, 'update'])->name('update')->middleware('auth');

Route::get('/newTask', [TaskController::class, 'create'])->name('newTask')->middleware('auth');
Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('editTask')->middleware('auth');
Route::post('/newTask', [TaskController::class, 'store'])->name('newTask')->middleware('auth');
Route::delete('/task/{task}/check', [TaskController::class, 'check'])->name('check')->middleware('auth');
Route::patch('/task/{task}/update', [TaskController::class, 'update'])->name('updateTask')->middleware('auth');
Route::delete('/task/{task}/delete', [TaskController::class, 'destroy'])->name('deleteTask')->middleware('auth');
Route::get('/oldTasks', [TaskController::class, 'oldTasks'])->name('oldTasks')->middleware('auth');

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar')->middleware('auth');