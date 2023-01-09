<?php

use App\Http\Livewire\AdminPanel;
use App\Http\Livewire\VoteForToday;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('vote');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// middleware auth route group
Route::middleware(['auth'])->group(function () {
    Route::get('/vote', VoteForToday::class)->name('vote');
});

// role admin middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', AdminPanel::class)->name('admin-panel');
});
