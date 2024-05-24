<?php
use App\Http\Controllers\homepageController;
use App\Http\Controllers\urlpageController;
use Illuminate\Support\Facades\Route;

Route::get('/',[homepageController::class,'index'])->name('home');

//list the urls
Route::get('/urls',[urlpageController::class,'index'])->name('urls');

//create a new url
Route::get('/urls/create',[urlpageController::class,'create'])->name('urls.create');

//store a new url
Route::post('/urls/create',[urlpageController::class,'store']);

//edit the existing url
Route::get('/urls/edit/{id}',[urlpageController::class,'edit'])->name('urls.edit');

//update  the existing url
Route::post('/urls/edit/{id}',[urlpageController::class,'update']);


//delete  the existing url
Route::post('/urls/delete/{id}',[urlpageController::class,'destroy'])->name('urls.destroy');

//route for short url
Route::get('/{short_url}',[urlpageController::class,'redirect']);

//view individual urls
Route::get('/urls/{id}',[ urlpageController::class, 'view'])->name('urls.view');
