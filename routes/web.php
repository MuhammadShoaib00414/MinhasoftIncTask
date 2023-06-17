<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsignmentController;

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

// Default Page
Route::get('/', function () {
    return redirect('login');
});

// Auth Routes
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// After Login
Route::middleware('auth')->group(function () {
    Route::get('/consignments', [ConsignmentController::class, 'index'])->name('consignments');
    // other protected routes...
    Route::any('/generate-pdf', [ConsignmentController::class, 'generate'])->name('generate-pdf');

});

