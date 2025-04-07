<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// routes/web.php

Route::resource('annonces', HomeController::class);


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/chat', [ChatController::class, 'index']);
Route::post('/annonces', [HomeController::class, 'store']);  // Route pour enregistrer une annonce
Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout');


// Route::get('/', function () {
//     return view('welcome');
// });
