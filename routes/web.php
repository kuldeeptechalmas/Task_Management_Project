<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Task_Controller;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;

// middleware
Route::middleware(["auth","authcheck"])->group(function () {
    Route::get('/show', [Task_Controller::class, 'show_table'])->name('show');
});
Route::middleware(["redirectauth"])->group(function () {
    Route::match(['post', 'get'], '/login', [AuthController::class, "login"])->name("login");
    
});

// all urls
Route::delete('/remove', [Task_Controller::class, 'remove'])->name('remove');
Route::post('/add', [Task_Controller::class, 'add'])->name('add');
Route::put('/modify', [Task_Controller::class, 'update'])->name('modify');
Route::get('/show-search', [Task_Controller::class, "searchdata"]);
Route::redirect("/", "/login")->name("home");
Route::match(['post', 'get'], '/registration', [AuthController::class, "registration"]);
Route::post('/logout', [AuthController::class, "logout"])->name("logout");

// sorting of title , discription and priority
Route::get('/sort', [Task_Controller::class, "sort"])->name("ascending");