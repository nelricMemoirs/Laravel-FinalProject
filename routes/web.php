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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('pertanyaan', 'PertanyaanController');Route::resource('jawaban', 'JawabanController');
Route::resource('jawaban', 'JawabanController');
Route::resource('pkomentar','PkomentarController');
Route::resource('jkomentar','JkomentarController');
Route::get('vote/upvote/{pertanyaan_id}', 'VoteController@vote')->name('vote');
Route::get('vote/downvote/{pertanyaan_id}', 'VoteController@downvote')->name('downvote');
Route::get('vote/bestanswer/{pertanyaan_id}', ['uses' =>'VoteController@bestanswer', 'as' => 'squirrel']);
