<?php

use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/user-registration', [userController::class, 'userRegistration'])->name('userRegistration');
Route::post('/user-login', [userController::class, 'userRegistration'])->name('userLogin');
