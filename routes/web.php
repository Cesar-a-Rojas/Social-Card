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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('api/authenticate', 'APIController@authenticate');
Route::post('api/register', 'APIController@register');

Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function () {
    Route::post('/index', 'APIController@index');

    Route::post('/user/socialMedia', 'APIController@userSocialMedia');
    Route::post('/user/categories', 'APIController@userCategories');
    Route::post('/user/cards', 'APIController@userCards');

    Route::post('user/socialMedia/add', 'APIController@addSocialMedia');
    Route::post('user/categories/add', 'APIController@addCategory');
    Route::post('user/cards/add', 'APIController@addCard');

});

Route::post('user/socialMedia/add', 'UserController@addSocialMedia')->name('addSocialMedia');
Route::post('user/categories/add', 'UserController@addCategory')->name('addCategory');
Route::post('user/cards/add', 'UserController@addCard')->name('addCard');

Route::get('/home', 'HomeController@index')->name('home');
