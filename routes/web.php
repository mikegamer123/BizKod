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
Route::get('/adminDashboard', function () {
    return view('main');
});
Route::get('/adminDashboard/createUser', function () {
    return view('createUser');
});
Route::get('/adminDashboard/user', function () {
    $users = \App\Models\User::all();
    return view('user',compact('users'));
});
Route::get('/adminDashboard/review', function () {
    $reviews = \App\Models\Review::all();
    return view('review',compact('reviews'));
});
Route::get('/adminDashboard/event', function () {
    return view('event');
});
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
