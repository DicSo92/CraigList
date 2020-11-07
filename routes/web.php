<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['auth:sanctum', 'verified'], function () {

});


//Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');


Route::get('/', \App\Http\Controllers\HomeController::class)->name('load');
Route::get('/{currentDepartmentSlug}', \App\Http\Controllers\HomeController::class)->name('home');



//Route::get('/{categorySlug}/{subCategorySlug}', '\App\Http\Controllers\AnnonceController@adsBySubCategory')->name('Annonce.adsBySubCategory');

Route::get('/{currentDepartmentSlug}/{categorySlug}/{subCategorySlug}', '\App\Http\Controllers\AnnonceController@adsBySubCategory')->name('Annonce.adsBySubCategory');

Route::get('/ad/create', function () {
    return Inertia::render('CreateAd/Index');
})->name('Annonce.create');
