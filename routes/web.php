<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth as CrmAuthController;
use App\Models\Photo;
use App\Models\Service;
use App\Models\Post;


// === Public routes ===
Route::get('/', function () {
    $services = Service::orderBy('id')->get();
    return view('home', compact('services'));
})->name('home');

Route::get('/galary', function () {
    return view('galary', ['photos' => Photo::orderByDesc('created_at')->paginate(10)]);
})->name('galary');

Route::get('/posts', function () {
    $posts = Post::All();
    return view('posts', compact('posts'));
})->name('posts');


// === Тут регистрация клиентов в том же контроллере что и отображение в CRM ===
Route::post('/client', [ClientController::class, 'store'])->name('client.store');

// === CRM Авторизация ===
Route::get('/crm/login', [CrmAuthController::class, 'showLoginForm'])->name('crm.login'); //форма входа
Route::post('/crm/login', [CrmAuthController::class, 'login'])->name('crm.login.post'); //действие входа
Route::post('/crm/logout', [CrmAuthController::class, 'logout'])->name('crm.logout'); //выход

Route::get('/crm', function () {
    return redirect()->route('crm.clients');
});

// === CRM Protected routes ===
Route::prefix('crm')->middleware(['crm.auth'])->as('crm.')->group(function () {  // общий префикс /crm
    Route::get('/clients', [ClientController::class, 'index'])->name('clients'); //вывод всех клиентов
    Route::resource('photos', PhotoController::class); //CRUD для CRM для фотографий
    Route::resource('services', ServiceController::class); //CRUD для CRM для услуг
    Route::resource('posts', PostController::class); //CRUD для CRM для постов
});