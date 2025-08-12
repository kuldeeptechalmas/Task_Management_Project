<?php

use App\Http\Controllers\Task_Controller;
use Illuminate\Support\Facades\Route;

// use ajax api

// Route::get('/add', [Task_Controller::class,'add'])->name('add');
// Route::post('/add', [Task_Controller::class,'add'])->name('add');
// Route::get('/', [Task_Controller::class,'show'])->name('show');
// Route::post('/remove', [Task_Controller::class,'remove'])->name('remove');

Route::get("/", [Task_Controller::class,"show_table"]);
Route::get("/show", [Task_Controller::class,"show"])->name("show");
Route::delete('/remove', [Task_Controller::class,'remove'])->name('remove');
Route::post('/add', [Task_Controller::class,'add'])->name('add');
Route::put('/modify', [Task_Controller::class,'update'])->name('modify');
Route::post('/show-search', [Task_Controller::class,"searchdata"]);
Route::post('/login', [Task_Controller::class,"login"]);

Route::get('/pusher',function(){
    return view('pusher');
});

// // use api only
// Route::get('/', [Task_Controller::class,'show'])->name('show');
// Route::get('/show-search', [Task_Controller::class,"searchdata"]);
// Route::get('/add', [Task_Controller::class,'add'])->name('add');
// Route::post('/add', [Task_Controller::class,'add'])->name('add');
// Route::post('/remove', [Task_Controller::class,'remove'])->name('remove');
// Route::get('/modify/{title}', [Task_Controller::class,'modify'])->name('modify');
// Route::post('/modify', [Task_Controller::class,'update'])->name('modify');