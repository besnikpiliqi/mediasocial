<?php

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
    return view('welcome');
});

Auth::routes(["verify"=>true]);
Route::get('/get-citys', [App\Http\Controllers\ProfileController::class, 'citys'])->name('country');

Route::group(['middleware'=> ['auth','verified'] ],function(){

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
    

    Route::get('/profile/{id?}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

    Route::get('/edit-profile', [App\Http\Controllers\ProfileController::class, 'edit'])->middleware('password.confirm')->name('edit-profile');
    Route::post('/edit-profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('edit-profile');
    
    Route::get('/post-comments', [App\Http\Controllers\HomeController::class, 'getComments'])->name('post-comments');
    Route::post('/vote-comment', [App\Http\Controllers\HomeController::class, 'voteComment'])->name('vote-comment');
    Route::post('/vote-post', [App\Http\Controllers\HomeController::class, 'votePost'])->name('vote-post');
    Route::post('/new-post', [App\Http\Controllers\HomeController::class, 'newPost'])->name('new-post');
    Route::post('/edit-post/{post}', [App\Http\Controllers\HomeController::class, 'editPost'])->name('vote-post');
    Route::post('/vote-comment', [App\Http\Controllers\HomeController::class, 'voteComment'])->name('vote-comment');
    Route::get('/check-vote-post/{post}', [App\Http\Controllers\HomeController::class, 'checkVotePost'])->name('check-vote-post');
    Route::get('/check-vote-comment/{comment}', [App\Http\Controllers\HomeController::class, 'checkVoteComment'])->name('check-vote-comment');
    Route::post('/delete-post/{post}', [App\Http\Controllers\HomeController::class, 'deletePost'])->name('delete-post');
    Route::post('/delete-comment/{comment}', [App\Http\Controllers\HomeController::class, 'deleteComent'])->name('delete-comment');
    Route::get('/following/{follow_id}', [App\Http\Controllers\ProfileController::class, 'following'])->name('following');
    Route::get('/followed/{follow_id}', [App\Http\Controllers\ProfileController::class, 'followed'])->name('followed');
    Route::post('/unfollow', [App\Http\Controllers\ProfileController::class, 'unfollow'])->name('unfollow');
    Route::post('/follow', [App\Http\Controllers\ProfileController::class, 'follow'])->name('follow');
    Route::post('/cancelfollow', [App\Http\Controllers\ProfileController::class, 'cancelfollow'])->name('cancelfollow');


});