<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\register_controller;
use App\Http\Controllers\login_controller;
use App\Http\Controllers\seeker_controller;
use App\Http\Controllers\activity_controller;
use App\Http\Controllers\route_controller;


Route::get('/', [route_controller::class, 'loginPage']);
Route::get('/register', [route_controller::class, 'registerPage']);
Route::get('/home', [route_controller::class, 'homePage']);
Route::get('/upload-activity', [route_controller::class, 'uploadActivityPage']);
Route::get('/activity', [route_controller::class, 'activityPage']);
Route::get('/be-a-seeker', [route_controller::class, 'beASeekerPage']);
Route::get('/done-activity', [route_controller::class, 'doneActivityPage']);
Route::get('/my-activities', [route_controller::class, 'myActivitiesPage']);
Route::get('/options/{id}', [route_controller::class, 'optionsPage']);
Route::get('/participants/{activity_id}', [route_controller::class, 'participantsPage'])->name('participants');
Route::get('/profile-user', [route_controller::class, 'profileUserPage']);
Route::get('/profile', [route_controller::class, 'profilePage']);
Route::get('/proposed-activities', [route_controller::class, 'proposedActivitiesPage']);
Route::get('/register-activity/{id}', [route_controller::class, 'registerActivityPage']);
Route::get('/see-details-done/{id}', [route_controller::class, 'seeDetailsDonePage'])->name('see-details-done');
Route::get('/see-details/{id}', [route_controller::class, 'seeDetailsPage'])->name('see-details');
Route::get('/edit-profile', [route_controller::class, 'editProfilePage']);
Route::get('/edit-portfolio', [route_controller::class, 'editPortfolioPage']);
Route::get('/view-portfolio', [route_controller::class, 'viewPortfolioPage']);
Route::get('/my-portfolio', [route_controller::class, 'myPortfolioPage']);




// BACKEND
Route::post('/user-register', [register_controller::class, 'register']);
Route::post('/user-login', [login_controller::class, 'login']);
Route::post('/register-seeker', [seeker_controller::class, 'registerSeeker'])->name('seeker.register');
Route::post('/upload-activity', [activity_controller::class, 'uploadActivity'])->name('activity.upload');
Route::post('/update-profile', [route_controller::class, 'updateProfile'])->name('profile.update');
Route::get('/delete-activity/{id}',[activity_controller::class, 'deleteActivity'])->name('activity.delete');
Route::post('/register-activity/{id}', [route_controller::class, 'submitRegisterActivity'])->name('activity.register');
Route::post('/toggle-ban/{volunteer_id}', [activity_controller::class, 'toggleBan'])->name('volunteer.toggleBan');
Route::post('/submit-proof/{activity_id}', [activity_controller::class, 'submitProof'])->name('activity.submitProof');
Route::post('/mark-done/{activity_id}', [activity_controller::class, 'markDone'])->name('activity.markDone');

require __DIR__ . '/settings.php';