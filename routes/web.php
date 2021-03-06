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

Route::group(['auth:sanctum', 'verified'], function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/ad/create', '\App\Http\Controllers\AnnonceController@create')->name('Annonce.create');

    Route::post('/annonce/favorite','\App\Http\Controllers\AnnonceController@toggleFavorite')->name('annonce.toggleFavorite');
});


Route::get('/', \App\Http\Controllers\HomeController::class)->name('load');
Route::get('/{currentDepartmentSlug}', \App\Http\Controllers\HomeController::class)->name('home');

Route::get('/{currentDepartmentSlug}/search/{search}', '\App\Http\Controllers\SearchController@index')->name('Search.index');

Route::get('/{currentDepartmentSlug}/{categorySlug}/{subCategorySlug}', '\App\Http\Controllers\AnnonceController@adsBySubCategory')->name('Annonce.adsBySubCategory');
Route::get('/{currentDepartmentSlug}/{categorySlug}/{subCategorySlug}/{annonceSlug}', '\App\Http\Controllers\AnnonceController@show')->name('Annonce.show');

Route::post('/ad/store', '\App\Http\Controllers\AnnonceController@store')->name('Annonce.store');
