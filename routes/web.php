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

    Route::get('/logout', function(){
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
    Route::get('/searche', [App\Http\Controllers\HomeController::class, 'searcheUser'])->name('searche');
    
    Route::get('/prov', [App\Http\Controllers\HomeController::class, 'prov']);

    Route::get('/profile/{username?}', [App\Http\Controllers\ProfileController::class, 'index'])
            ->where(['username' => '[A-Za-z0-9.]+'])
            ->name('profile');
    
    Route::get('/notification', [App\Http\Controllers\SettingController::class, 'notification'])->name('notification');
    Route::get('/more-notification', [App\Http\Controllers\SettingController::class, 'moreNotifications'])->name('more.notifications');

    Route::group(['prefix' => 'settings'], function()
    {
        Route::get('/', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.home');
        Route::get('/history', [App\Http\Controllers\SettingController::class, 'history'])->name('settings.history');
        Route::get('/request', [App\Http\Controllers\SettingController::class, 'request'])->name('settings.request');
        
    });
    Route::group([
        'prefix' => 'accounts/{account_id}',
        'where' => ['account_id' => '[0-9]+'],
    ], function() {
    
        Route::get('detail', function($account_id){
            //
        });
    });
    

    Route::get('/comportement', [App\Http\Controllers\ProfileController::class, 'comportementUser'])->name('comportement');
    Route::get('/checkcomportement', [App\Http\Controllers\ProfileController::class, 'checkTheComportemnt'])->name('checkcomportement');
    Route::get('/edit-profile', [App\Http\Controllers\ProfileController::class, 'edit'])->middleware('password.confirm')->name('edit-profile');
    Route::post('/edit-profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('edit-profile');
    
    Route::get('/post-comments', [App\Http\Controllers\HomeController::class, 'getComments'])->name('post-comments');
    Route::post('/vote-comment', [App\Http\Controllers\HomeController::class, 'voteComment'])->name('vote-comment');
    Route::post('/vote-post', [App\Http\Controllers\HomeController::class, 'votePost'])->name('vote-post');
    Route::post('/new-post', [App\Http\Controllers\HomeController::class, 'newPost'])->name('new-post');
    Route::post('/new-comment', [App\Http\Controllers\HomeController::class, 'newComment'])->name('new-comment');
    Route::post('/edit-comment/{comment}', [App\Http\Controllers\HomeController::class, 'editComment'])->name('edit-comment');
    Route::post('/edit-post/{post}', [App\Http\Controllers\HomeController::class, 'editPost'])->name('vote-post');
    Route::post('/vote-comment', [App\Http\Controllers\HomeController::class, 'voteComment'])->name('vote-comment');
    Route::get('/check-vote-post/{post}', [App\Http\Controllers\HomeController::class, 'checkVotePost'])->name('check-vote-post');
    Route::get('/check-vote-comment/{comment}', [App\Http\Controllers\HomeController::class, 'checkVoteComment'])->name('check-vote-comment');
    Route::post('/delete-post/{post}', [App\Http\Controllers\HomeController::class, 'deletePost'])->name('delete-post');
    Route::post('/delete-comment/{comment}', [App\Http\Controllers\HomeController::class, 'deleteComent'])->name('delete-comment');
    Route::get('/following', [App\Http\Controllers\ProfileController::class, 'following'])->name('following');
    Route::get('/followed', [App\Http\Controllers\ProfileController::class, 'followed'])->name('followed');
    Route::post('/unfollow', [App\Http\Controllers\ProfileController::class, 'unfollow'])->name('unfollow');
    Route::post('/follow', [App\Http\Controllers\ProfileController::class, 'follow'])->name('follow');
    Route::post('/cancelfollowed', [App\Http\Controllers\ProfileController::class, 'deleteFollowedRequest'])->name('cancelfollowed');
    Route::post('/cancelfollowing', [App\Http\Controllers\ProfileController::class, 'deleteFollowingRequest'])->name('cancelfollowing');


});