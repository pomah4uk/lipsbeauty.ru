<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth as CrmAuthController;
use App\Models\Photo;
use App\Models\Service;
use App\Models\ArticleModal;

// === Public routes ===
Route::get('/', function () {
    $services = Service::orderBy('id')->get();
    return view('home', compact('services'));
})->name('home');

Route::get('/galary', function () {
    return view('galary', ['photos' => Photo::orderByDesc('created_at')->paginate(10)]);
})->name('galary');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{article}', [BlogController::class, 'show'])->name('blog.show');

Route::post('/client', [ClientController::class, 'store'])->name('client.store');

// === CRM Auth ===
Route::get('/crm/login', [CrmAuthController::class, 'showLoginForm'])->name('crm.login');
Route::post('/crm/login', [CrmAuthController::class, 'login'])->name('crm.login.post');
Route::post('/crm/logout', [CrmAuthController::class, 'logout'])->name('crm.logout');

// === CRM Protected routes ===
Route::prefix('crm')->middleware(['crm.auth'])->as('crm.')->group(function () {
    Route::resource('photos', PhotoController::class);
    Route::get('/clients', [AdminController::class, 'clients'])->name('clients');
    Route::resource('articles', ArticleController::class);
    Route::get('/promotion', [AdminController::class, 'promotion'])->name('promotion');
    Route::resource('services', ServiceController::class);
});

// Редирект /crm на список фото
Route::redirect('/crm', route('crm.photos.index'));