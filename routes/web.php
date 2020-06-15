<?php

use App\Question;
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
Route::resource('/question','QuestionController')->except('show');
// Route::post('Question/{question}/answers/{answer}','AnswersController@store')->name('Answers.store');
Route::resource('question.answers','AnswersController')->except(['index','create','show']);
Route::get('/question/{slug}','QuestionController@Show')->name('question.show');
