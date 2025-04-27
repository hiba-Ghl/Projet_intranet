<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AuthController;
// routes/web.php

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
