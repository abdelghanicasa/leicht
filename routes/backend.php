<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PagesController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\SliderController;

Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Pages Management Routes (No Auth Middleware)
Route::get('/pages', [PagesController::class, 'index'])->name('admin.pages.index');
Route::get('/pages/create', [PagesController::class, 'create'])->name('admin.pages.create');
Route::post('/pages', [PagesController::class, 'store'])->name('admin.pages.store');
Route::get('/pages/{id}/edit', [PagesController::class, 'edit'])->name('admin.pages.edit');
Route::put('/pages/{id}', [PagesController::class, 'update'])->name('admin.pages.update');
Route::delete('/pages/{id}', [PagesController::class, 'destroy'])->name('admin.pages.destroy');
Route::delete('pages/images/{id}', [PagesController::class, 'deleteImage'])->name('admin.pages.deleteImage');

Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('admin.settings.update');

Route::resource('sliders', SliderController::class);
// Route::get('/pages/{pageId}/gallery/create', [PagesController::class, 'createGallery'])->name('gallery.create');
// Route::post('/pages/{pageId}/gallery/store', [PagesController::class, 'storeGallery'])->name('admin.pages.storeGallery');



// 4️⃣ Middleware for Backend Authentication (Optional)
// To restrict access to the backend for admins only, apply middleware in routes/backend.php:

/*
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
*/