<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/about', function () {
//     return view('about');
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

Route::get('/', [App\Http\Controllers\FrontendController::class, 'homepage']);
Route::get('/about', [App\Http\Controllers\FrontendController::class, 'aboutpage']);
Route::get('/contact', [App\Http\Controllers\FrontendController::class, 'contactpage']);
Route::get('/category/{name}', [App\Http\Controllers\FrontendController::class, 'categorypage']);

Route::get('/profile', [App\Http\Controllers\FrontendController::class, 'profilepage'])->middleware('auth', 'verified');

Auth::routes([
    'verify' => true,
]);

// Route::get('/home', [App\Http\Controllers\FrontendController::class, 'homepage'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'admin']);
    Route::resource('/category', App\Http\Controllers\CategoryController::class);
});
