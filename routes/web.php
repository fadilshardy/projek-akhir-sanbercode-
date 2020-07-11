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
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/forum', 'ForumController@index');

Route::resource('jawaban', 'AnswerController');
Route::post('/jawaban/{answer}/upvote', 'AnswerController@upvote');
Route::post('/jawaban/{answer}/downvote', 'AnswerController@downvote');
Route::post('/jawaban/{answer}/unvote/{status}', 'AnswerController@unvote');
Route::put('jawaban/{id}/right', 'AnswerController@right');

Route::resource('komentar_pertanyaan', 'CommentQuestionController')->except(['create']);
Route::get('komentar_pertanyaan/create/{id}', 'CommentQuestionController@create');

Route::resource('komentar_jawaban', 'CommentAnswerController')->except(['create']);
Route::get('komentar_jawaban/create/{id}', 'CommentAnswerController@create');

Route::resource('pertanyaan', 'QuestionController')->except(['index','show']);

Route::resource('profile', 'ProfileController')->except(['show']);
Route::post('/pertanyaan/{question}/upvote', 'QuestionController@upvote');
Route::post('/pertanyaan/{question}/downvote', 'QuestionController@downvote');
Route::post('/pertanyaan/{question}/unvote/{status}', 'QuestionController@unvote');
});
Route::get('pertanyaan', 'QuestionController@index')->name('index');
Route::post('pertanyaan/cari', 'QuestionController@search');
Route::get('tag/{id}', 'QuestionController@tag')->name('tag');
Route::get('pertanyaan/{id}', 'QuestionController@show');
Route::get('profile/{id}', 'ProfileController@show');
Route::get('rank', 'ProfileController@rank');
// Route::get('pertanyaan/{id}/edit', 'QuestionController@edit');
// Route::delete('pertanyaan/{id}/delete', 'QuestionController@destroy');
