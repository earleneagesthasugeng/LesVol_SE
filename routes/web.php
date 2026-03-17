<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\register_controller;
use App\Http\Controllers\login_controller;

Route::get('/', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/upload-activity', function () {
    return view('upload-activity');
});

Route::get('/activity', function () {
    return view('activity');
});

Route::get('/be-a-seeker', function () {
    return view('be-a-seeker');
});

Route::get('/done-activity', function () {
    return view('done-activity');
});

Route::get('/my-activities', function () {
    return view('my-activities');
});

Route::get('/options', function () {
    return view('options');
});

Route::get('/participants', function () {
    return view('participants');
});

Route::get('/profile-user', function () {
    return view('profile-user');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/proposed-activities', function () {
    return view('proposed-activities');
});

Route::get('/register-activity', function () {
    return view('register-activity');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/see-details-done', function () {
    return view('see-details-done');
});

Route::get('/see-details', function () {
    return view('see-details');
});

// BACKEND
Route::post('/user-register', [register_controller::class,'register']);
Route::post('/user-login', [login_controller::class,'login']);

require __DIR__.'/settings.php';