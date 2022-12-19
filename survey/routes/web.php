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
Route::group(['namespace' => 'App\Http\Controllers'], function () {

    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

});

Route::group(['namespace' => 'App\Http\Controllers\Survey'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/survey/create', 'SurveyController@index')->name('survey.create.show');
        Route::post('/survey/create', 'SurveyController@create')->name('survey.create');

        Route::get('/survey/edit/{id}', 'SurveyController@edit')->name('survey.edit');
        Route::post('/survey/edit/{id}', 'SurveyController@update')->name('survey.update');
        Route::get('/survey/delete/{id}', 'SurveyController@delete')->name('survey.delete');

        Route::get('/survey/take/{id}', 'SurveyController@takeSurvey')->name('survey.take');

        Route::get('/survey/own', 'SurveyController@ownSurvey')->name('survey.index.own');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});
