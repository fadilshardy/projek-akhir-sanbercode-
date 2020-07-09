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
Route::post('/jawaban/{answer}/upvote', 'AnswerController@upvote');
Route::post('/jawaban/{answer}/downvote', 'AnswerController@downvote');
Route::post('/jawaban/{answer}/unvote/{status}', 'AnswerController@unvote');
Route::put('jawaban/{id}/right', 'AnswerController@right');

Route::resource('komentar_pertanyaan', 'CommentQuestionController')->except(['create']);
Route::get('komentar_pertanyaan/create/{id}', 'CommentQuestionController@create');

Route::resource('pertanyaan', 'QuestionController');
Route::post('/pertanyaan/{question}/upvote', 'QuestionController@upvote');
Route::post('/pertanyaan/{question}/downvote', 'QuestionController@downvote');
Route::post('/pertanyaan/{question}/unvote/{status}', 'QuestionController@unvote');
