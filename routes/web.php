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
    return view('phonebook');
})->name('home');

Route::fallback(function() {
    return view('phonebook');
});

Route::resource('phonebook', 'PhonebookController');
Route::get('/allContacts', 'PhonebookController@getContacts')->name('contacts');


// Auths
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout');
