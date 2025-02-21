<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CuisineController;
use App\Http\Controllers\Frontend\DressingsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlocController;

/* ------Categories-------- */
Route::resource('categories', CategoryController::class);

/* ------Pages-------- */
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/nos-univers', [PageController::class, 'home'])->name('nos-univers');
Route::get('/nos-cuisines', [PageController::class, 'cuisines'])->name('page.cuisines');
Route::get('/nos-dressings', [PageController::class, 'dressings'])->name('page.dressings');
Route::get('/nos-realisations', [PageController::class, 'realisations'])->name('page.realisations');
Route::get('/contact', [PageController::class, 'contact'])->name('page.contact');
Route::post('/send-email', [PageController::class, 'sendEmail'])->name('page.send');
Route::get('/instagram', [PageController::class, 'getInstagramPosts']);

Route::resource('admin/blocs', BlocController::class)->except(['show']);