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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'App\Http\Controllers\Page\SettingController@index')->name('setting');
    Route::get('/logout', 'App\Http\Controllers\Auth\LogoutController@perform')->name('logout.perform');
    Route::post('/send_code', 'App\Http\Controllers\Page\SettingController@sendCode')->name('setting.send_code');
    Route::post('/save', 'App\Http\Controllers\Page\SettingController@save')->name('setting.save');
});

Route::group(['middleware' => ['guest']], function() {
    Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@show')->name('register');
    Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register.perform');

    Route::get('/login', 'App\Http\Controllers\Auth\LoginController@show')->name('login');
    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login.perform');
});
