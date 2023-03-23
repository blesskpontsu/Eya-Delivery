<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verify.otp'])->name('dashboard');

Route::middleware(['auth', 'verify.otp'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->name('admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard')->name('dashbaord');
        });
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});

require __DIR__ . '/auth.php';
