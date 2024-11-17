<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Authenticate;
use Illuminate\Console\View\Components\Mutators\EnsurePunctuation;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registrationProcess', [AuthController::class, 'registrationProcess'])->name('registrationProcess');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');



Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/updateProfile', [AuthController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});




// Route::get('/profile', function(){
//     return view('frontend.auth.profile');
// })->name('profile')->middleware(EnsureTokenIsValid::class);

// Route::group(['/'], function(){


// });