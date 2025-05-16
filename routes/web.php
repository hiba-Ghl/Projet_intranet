<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AuthController;
// routes/web.php

Route::resource('annonces', HomeController::class);


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/annonces', [HomeController::class, 'store'])->name('annonces.store');
Route::get('/search', [HomeController::class, 'search'])->name('annonces.search');
Route::get('/annonces/create', [HomeController::class, 'create'])->name('annonces.create');
Route::delete('/annonce/{id}', [HomeController::class, 'destroy'])->name('annonce.destroy');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout');

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Chat routes with names
Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::get('/chat/messages/{discussionId}', [ChatController::class, 'getMessages'])->name('chat.messages');
Route::post('/chat/messages/{discussionId}', [ChatController::class, 'sendMessage'])->name('chat.send');

// Annonces routes
Route::resource('annonces', HomeController::class);
Route::post('/annonces', [HomeController::class, 'store']);  // Route pour enregistrer une annonce


// Route::get('/', function () {
//     return view('welcome');
// });
