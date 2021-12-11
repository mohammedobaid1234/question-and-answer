<?php

use App\Http\Controllers\answerController;
use App\Http\Controllers\BadgesController;
use App\Http\Controllers\questionController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VoteController;
use App\Models\Question;
use App\Models\User;
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


Route::get('/',  [questionController::class, 'index'])->name('home');
Route::get('/search', [questionController::class , 'search'])->name('main.search');
Route::get('questions/tagged/{name}',[questionController::class , 'tagged'])->name('questions.tagged');
Route::resource('questions', questionController::class);
Route::resource('answers', answerController::class);
Route::post('users', [UsersController::class , 'index'])->name('users.index');
Route::get('users', [UsersController::class, 'search'])->name('users.search');
Route::get('users/name/{name}',[UsersController::class, 'getPage'])->name('users.getPage');
Route::get('users/{user}/{type?}/{order?}', [UsersController::class , 'show'])->name('users.show');
// Route::resource('users', UsersController::class);
Route::post('votes/increase/{type}/{id}', [VoteController::class, 'increase'])->name('votes.increase')->where('type', 'question|answer');
Route::post('votes/decrease/{type}/{id}', [VoteController::class, 'decrease'])->name('votes.decrease')->where('type', 'question|answer');
// Route::get('/dashboard', [questionController::class, 'index'])
// ->middleware(['auth'])->name('dashboard');
Route::get('badges', [BadgesController::class , 'index'])->name('badges.index');
Route::get('badges/{slug}', [BadgesController::class , 'show'])->name('badges.show');
Route::get('tags', [TagsController::class , 'index'])->name('tags.index');
Route::get('tags/search', [TagsController::class , 'search'])->name('tags.search');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
