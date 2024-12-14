<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\PostJobController;
use Illuminate\Console\View\Components\Mutators\EnsurePunctuation;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registrationProcess', [AuthController::class, 'registrationProcess'])->name('registrationProcess');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/jobs', [JobsController::class, 'index'])->name('jobs');



Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/updateProfile', [AuthController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // POST JOB ROUTES
    Route::get('/create_post_job', [PostJobController::class, 'index'])->name('create_post_job');
    Route::post('/save_post_job', [PostJobController::class, 'saveJobs'])->name('save_post_job');
    Route::get('/show_post_job/{jobId}', [PostJobController::class, 'showJobs'])->name('show_post_job');
    Route::post('/edit_post_job/{jobId}', [PostJobController::class, 'editJobs'])->name('edit_post_job');
    Route::get('/delete_post_job', [PostJobController::class, 'deleteJob'])->name('delete_post_job');
    Route::get('/my_jobs', [PostJobController::class, 'myJobs'])->name('my_jobs');
});




Route::get('/job_detail', function(){
    return view('frontend.job.job_detail');
})->name('job_detail');

// Route::group(['/'], function(){


// });