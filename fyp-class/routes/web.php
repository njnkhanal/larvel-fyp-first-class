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
Route::get('/job/{id}', [App\Http\Controllers\FrontendController::class, 'jobdetail'])->name('job.detail');

Route::middleware(['auth'])->group(function () {
    Route::get('/job/{id}/applied', [App\Http\Controllers\FrontendController::class, 'jobApplied'])->name('job.applied');
    Route::post('/job/{id}', [App\Http\Controllers\ApplyJobController::class, 'store'])->name('job.apply.store');
});

Route::get('/about', [App\Http\Controllers\FrontendController::class, 'aboutpage']);
Route::get('/contact', [App\Http\Controllers\FrontendController::class, 'contactpage']);
// Route::get('/category/{name}', [App\Http\Controllers\FrontendController::class, 'categorypage']);

Route::get('/profile', [App\Http\Controllers\FrontendController::class, 'profilepage'])->middleware('auth', 'verified')->name('my.profile');

Auth::routes([
    'verify' => true,
]);

// Route::get('/home', [App\Http\Controllers\FrontendController::class, 'homepage'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'admin']);
    Route::get('/jobapply', [App\Http\Controllers\ApplyJobController::class, 'index'])->name('applyjob.index');
    Route::get('/jobapply/{type}/status/{id}', [App\Http\Controllers\ApplyJobController::class, 'statusUpdate'])->name('applyjob.index.update');
    Route::resource('/category', App\Http\Controllers\CategoryController::class);
    Route::resource('/company', App\Http\Controllers\CompanyController::class);
    Route::resource('/job', App\Http\Controllers\JobController::class);
    Route::resource('/user', App\Http\Controllers\UserController::class);
});

Route::prefix('company')->as('company.')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\CompanyController::class, 'company']);
    Route::resource('/job', App\Http\Controllers\CompanyJobController::class);
});
