<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// routes/web.php

Route::resource('annonces', HomeController::class);


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/annonces', [HomeController::class, 'store'])->name('annonces.store');
Route::get('/search', [HomeController::class, 'search'])->name('annonces.search');
Route::get('/annonces/create', [HomeController::class, 'create'])->name('annonces.create');
Route::delete('/annonce/{id}', [HomeController::class, 'destroy'])->name('annonce.destroy');

Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout');



// Route::get('/', function () {
//     return view('welcome');
// });
