<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/forum', 'ForumController@index');

Route::resource('jawaban', 'AnswerController');

Route::resource('pertanyaan', 'QuestionController');
Route::post('/pertanyaan/{question}/upvote', 'QuestionController@upvote');
Route::post('/pertanyaan/{question}/downvote', 'QuestionController@downvote');
Route::post('/pertanyaan/{question}/unvote', 'QuestionController@unvote');
