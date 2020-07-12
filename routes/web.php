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
Route::group(['middleware' => 'auth'], function () { //auth scope
Route::get('/home', 'HomeController@index')->name('home'); //home
Route::get('/forum', 'ForumController@index'); //forum

Route::resource('jawaban', 'AnswerController'); //route resource jawaban
Route::post('/jawaban/{answer}/upvote', 'AnswerController@upvote'); //route upvote jawaban
Route::post('/jawaban/{answer}/downvote', 'AnswerController@downvote'); //route downvote jawaban
Route::post('/jawaban/{answer}/unvote/{status}', 'AnswerController@unvote'); //route status vote jawaban
Route::put('jawaban/{id}/right', 'AnswerController@right'); //route tandai jawaban yang benar

Route::delete('/jawaban/{id}/delete_comment/', 'AnswerController@delete_comment'); //route hapus komentar jawaban
Route::resource('komentar_pertanyaan', 'CommentQuestionController')->except(['create']); //route resource komentar pertanyaan
Route::get('komentar_pertanyaan/create/{id}', 'CommentQuestionController@create'); //route custom create komentar pertanyaan

Route::resource('komentar_jawaban', 'CommentAnswerController')->except(['create']); //route resource komentar jawaban
Route::get('komentar_jawaban/create/{id}', 'CommentAnswerController@create');//route custom create komentar jawaban

Route::resource('pertanyaan', 'QuestionController')->except(['index','show']);//route resource pertanyaan kecuali index dan show, karena index dan show dapat di akses public

Route::resource('profile', 'ProfileController')->except(['show']); //route resource profile kecuali show, karena show dapat di akses public
Route::post('/pertanyaan/{question}/upvote', 'QuestionController@upvote'); //route upvote pertanyaan
Route::post('/pertanyaan/{question}/downvote', 'QuestionController@downvote'); //route downvote pertanyaan
Route::post('/pertanyaan/{question}/unvote/{status}', 'QuestionController@unvote'); //route status vote pertanyaan

Route::delete('/pertanyaan/{id}/delete_comment/', 'QuestionController@delete_comment');//route delete komen pertanyaan

});
//public route
Route::get('pertanyaan', 'QuestionController@index')->name('index');
Route::post('pertanyaan/cari', 'QuestionController@search');
Route::get('tag/{id}', 'QuestionController@tag')->name('tag');
Route::get('pertanyaan/{id}', 'QuestionController@show');
Route::get('profile/{id}', 'ProfileController@show');
Route::get('rank', 'ProfileController@rank');
// Route::get('pertanyaan/{id}/edit', 'QuestionController@edit');
// Route::delete('pertanyaan/{id}/delete', 'QuestionController@destroy');
