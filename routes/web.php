<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WasabiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UploaderController;
use App\Http\Controllers\MediaLibraryController;
use App\Http\Controllers\ViewController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome2');
});

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/user/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verification-notification', function () {
    Auth::user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/home', [UserController::class, 'home']);
    Route::get('/user/file/delete/{id}', [UserController::class, 'deleteFile']);
});
Route::get('oauth/google', [LoginController::class, 'redirectToProvider'])->name('oauth.google');
Route::get('oauth/google/callback', [LoginController::class, 'handleProviderCallback'])->name('oauth.google.callback');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
Route::get('/testing', [WasabiController::class, 'convert']);
Route::get('/view/{id}', [ViewController::class, 'view']);
Route::post('file-upload/upload-large-files', [WasabiController::class, 'upload'])->name('files.upload.large');
