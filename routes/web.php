<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
   return redirect('/login');
});


Auth::routes();

Route::get('/toolkit', function () {
    return response()->json([
        'message' => 'Welcome to your new application!'
    ]);
})->middleware('apitoolkit');

// GUEST ROUTES
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/check_account_type', [HomeController::class, 'check_account_type'])->name('check_account_type');

// SUPER ADMIN ROUTES
Route::prefix('super-admin')->middleware(['auth', 'SuperAdmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/property-detail/{id}', [AdminController::class, 'property_detail'])->name('property.detail');
    Route::get('/appartment-detail/{id}', [AdminController::class, 'appartment_detail'])->name('appartment.detail');
}); 
// PROPERTY OWNER ROUTES
Route::prefix('property-owner')->middleware(['auth', 'PropertyOwner'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('propertyowner.dashboard');
});


// // FLAT OWNER ROUTES
Route::prefix('flat-owner')->middleware(['auth', 'Flatowner'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('flatowner.dashboard');
});
