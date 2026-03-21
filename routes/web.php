<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\JobController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterTypeController;

use App\Http\Controllers\Employer\DashboardController;



Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/about',[AboutController::class,'index'])->name('about');

Route::get('/contact',[ContactController::class,'index'])->name('contact');

Route::get('/faq',[FaqController::class,'index'])->name('faq');

Route::get('/jobs',[JobController::class,'index'])->name('jobs');

Route::get('/jobs/{slug}',[JobController::class,'detail'])->name('job.detail');


Route::middleware('guest:employee,employer')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterTypeController::class, 'index'])
        ->name('register.type');
    Route::get('/register/{type}', [RegisterTypeController::class, 'redirect'])
        ->name('register.redirect');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



//EMpoyee locations ajax
Route::get('/designations/{designation}/locations', [App\Http\Controllers\Employee\RegisterController::class, 'locations']);
    

// Employee Routes
Route::group(['prefix' => 'employee', 'as' => 'employee.'], function () {
    // Auth Routes
    Route::middleware('guest:employee')->group(function () {
        Route::get('register', [App\Http\Controllers\Employee\RegisterController::class, 'create'])->name('register');
        Route::post('register', [App\Http\Controllers\Employee\RegisterController::class, 'store'])->name('register.store');
    
       
    });


    // Dashboard & Profile
    Route::get('dashboard', function () {
        return view('employee.dashboard');
    })->middleware(['auth:employee', 'verified'])->name('dashboard');


});


// Email Verification Routes (Standard names required by Laravel)
Route::middleware('auth:employee')->group(function () {
    Route::get('/employee/email/verify', function () {
        return view('employee.auth.verify');
    })->name('verification.notice');

    Route::get('/employee/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('employee.dashboard');
    })->middleware('signed')->name('verification.verify');

    Route::post('/employee/email/verification-notification', function (\Illuminate\Http\Request $request) {
        $request->user('employee')->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
    
});





// Employer Routes
Route::group(['prefix' => 'employer', 'as' => 'employer.'], function () {
    // Auth Routes
    Route::middleware('guest:employer')->group(function () {
        Route::get('register', [App\Http\Controllers\Employer\RegisterController::class, 'create'])->name('register');
        Route::post('register', [App\Http\Controllers\Employer\RegisterController::class, 'store'])->name('register.store');
    });


    // Dashboard
    Route::get('dashboard', function () {
        return view('employer.dashboard');
    })->middleware('auth:employer')->name('dashboard');

});


    Route::prefix('employer')->name('employer.')->middleware('auth:employer')->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::get('/jobs', [App\Http\Controllers\Employer\JobController::class, 'index'])->name('jobs.index');

    Route::get('/jobs/new', [App\Http\Controllers\Employer\JobController::class, 'create'])->name('jobs.create');

    Route::post('/jobs', [App\Http\Controllers\Employer\JobController::class, 'store'])->name('jobs.store');

    Route::get('/jobs/{job}', [App\Http\Controllers\Employer\JobController::class,'show'])->name('jobs.show');

    Route::get('/jobs/{job}/applicants', [App\Http\Controllers\Employer\JobController::class,'applicants'])->name('jobs.applicants');

    Route::get('/jobs/{job}/edit', [App\Http\Controllers\Employer\JobController::class, 'edit'])->name('jobs.edit');

    Route::put('/jobs/{job}', [App\Http\Controllers\Employer\JobController::class, 'update'])->name('jobs.update');

    Route::get('/profile/edit',[App\Http\Controllers\Employer\ProfileController::class,'edit'])->name('profile.edit');

    Route::put('/profile/update',[App\Http\Controllers\Employer\ProfileController::class,'update'])->name('profile.update');

    Route::get('/change-password', [App\Http\Controllers\Employer\ProfileController::class,'changePassword'])->name('password');

    Route::put('/change-password', [App\Http\Controllers\Employer\ProfileController::class,'updatePassword'])->name('password.update');




    });



    Route::prefix('employee')->name('employee.')->middleware('auth:employee')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Employee\DashboardController::class,'index'])->name('dashboard');

    Route::get('/jobs', [App\Http\Controllers\Employee\JobController::class, 'index'])->name('jobs.index');

    Route::get('/jobs/new', [App\Http\Controllers\Employee\JobController::class, 'create'])->name('jobs.create');

    Route::post('/job/apply/{id}',[App\Http\Controllers\Employee\JobApplicationController::class,'apply'])->name('job.apply');

    Route::get('/profile/edit',[App\Http\Controllers\Employee\ProfileController::class,'edit'])->name('profile.edit');

    Route::put('/profile/update',[App\Http\Controllers\Employee\ProfileController::class,'update'])->name('profile.update');

    Route::get('/change-password', [App\Http\Controllers\Employee\ProfileController::class,'changePassword'])->name('password');

    Route::put('/change-password', [App\Http\Controllers\Employee\ProfileController::class,'updatePassword'])->name('password.update');


    });



    // APIs for dynamic selection
    Route::get('/api/categories/{category}/designations', function (\App\Models\Category $category) {
        return response()->json($category->designations()->orderBy('name', 'asc')->get());
    })->name('api.designations.by_category');