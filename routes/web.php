<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Task_Controller;
use Illuminate\Support\Facades\Route;

Route::get("/show", [Task_Controller::class,"show_table"])->name("show");
Route::get("/show-table", [Task_Controller::class,"show"]);
Route::delete('/remove', [Task_Controller::class,'remove'])->name('remove');
Route::post('/add', [Task_Controller::class,'add'])->name('add');
Route::put('/modify', [Task_Controller::class,'update'])->name('modify');
Route::post('/show-search', [Task_Controller::class,"searchdata"]);


Route::match(['post','get'],'/login', [AuthController::class,"login"])->name("login");
Route::match(['post','get'],'/registration', [AuthController::class,"registration"]);
Route::post('/logout', [AuthController::class,"logout"])->name("logout");

Route::get('/pusher',function(){
    return view('pusher');
});

