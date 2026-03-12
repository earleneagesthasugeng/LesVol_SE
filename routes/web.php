<?php

use Illuminate\Support\Facades\Route;

Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');

// // Main pages
// Route::view('/home', 'home')->name('home');
// Route::view('/activity', 'activity')->name('activity');

// // My Activities section
// Route::view('/my-activities', 'my-activities')->name('my-activities');
// Route::view('/proposed-activities', 'proposed-activities')->name('proposed-activities');
// Route::view('/upload-activity', 'upload-activity')->name('upload-activity');

// // Detail pages
// Route::view('/see-details', 'see-details')->name('see-details');
// Route::view('/options', 'options')->name('options');
// Route::view('/participants', 'participants')->name('participants');
// Route::view('/register-activity', 'register-activity')->name('register-activity');

// // Profiles
// Route::view('/profile', 'profile')->name('profile');
// Route::view('/profile-user', 'profile-user')->name('profile-user');

require __DIR__.'/settings.php';