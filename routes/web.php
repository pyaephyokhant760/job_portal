<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jobController;
use App\Http\Controllers\ajaxController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\loginMiddleware;
use App\Http\Middleware\accountMiddleware;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SaveJobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobApplicationController;


Route::middleware(['login_middleware'])->group(function () {
    Route::get('/register/page',[AccountController::class,'registerPage'])->name('accountRegisterPage');
    Route::get('/login/page',[AccountController::class,'loginPage'])->name('accountLoginPage');

});

Route::redirect('/', 'home');
Route::get('home',[HomeController::class,'homePage'])->name('homePage');
Route::get('jobs',[jobController::class,'jobPage'])->name('jobPage');
Route::get('detail/{id}',[jobController::class,'detailPage'])->name('detailPage');

Route::prefix('ajax')->group(function() {
    Route::get('sorting',[ajaxController::class,'sortingPage'])->name('sortingPage');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

    Route::middleware([accountMiddleware::class])->group(function() {
        Route::get('profile',[AccountController::class,'profilePage'])->name('profilePage');
        Route::post('getProfile',[AccountController::class,'getProfilePage'])->name('getProfilePage');
        Route::post('getPhoto',[AccountController::class,'getPhotoPage'])->name('getPhotoPage');
        Route::get('jobPost',[jobController::class,'jobPostPage'])->name('jobPostPage');
        Route::post('getDataJob',[jobController::class,'getDataJobPage'])->name('getDataJobPage');
        Route::get('myJob',[jobController::class,'myJobPage'])->name('myJobPage');
        Route::get('edit/{id}',[jobController::class,'editPage'])->name('editPage');
        Route::post('edit/post/{id}',[jobController::class,'editPost'])->name('editPost');
        Route::get('delete/{id}',[jobController::class,'deletePage'])->name('deletePage');
        Route::get('view/{id}',[jobController::class,'viewPage'])->name('viewPage');
        Route::get('app/jobs',[ApplicationController::class,'appJobsPage'])->name('appJobsPage');
        Route::get('app/view/{id}',[ApplicationController::class,'appView'])->name('appView');
        Route::get('app/delete/{id}',[ApplicationController::class,'appDelete'])->name('appDelete');
        Route::get('saveJob',[SaveJobController::class,'saveJob'])->name('saveJob');
        Route::get('saveJob/view/{id}',[SaveJobController::class,'saveJobView'])->name('saveJobView');
        Route::get('saveJob/delete/{id}',[SaveJobController::class,'saveJobDelete'])->name('saveJobDelete');
    });

    Route::prefix('password')->group(function() {
        Route::post('get',[AccountController::class,'getPasswordPage'])->name('getPasswordPage');
    });

    Route::prefix('ajax')->group(function() {
        Route::get('detail/page',[JobApplicationController::class,'ajaxDetailPage'])->name('ajaxDetailPage');
        Route::get('save/job',[SaveJobController::class,'saveJobPage'])->name('saveJobPage');
    });
});

