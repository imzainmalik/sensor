<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AppartmentController;
use App\Http\Controllers\SensorDeviceController;
use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\PropertyOwner\PropertyOwnerController;
use App\Http\Controllers\AppartmentOwner\AppartmentOwnerController;
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
Route::get('/dashboard', [HomeController::class, 'check_account_type'])->name('check_account_type');

// SUPER ADMIN ROUTES
Route::prefix('super-admin')->middleware(['auth', 'SuperAdmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/property-detail/{id}', [AdminController::class, 'property_detail'])->name('property.detail');
    Route::get('/appartment-detail/{id}', [AdminController::class, 'appartment_detail'])->name('appartment.detail');

    //property Routes start
    Route::get('/property/create', [PropertyController::class, 'create'])->name('property.create');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');
    Route::get('/property/edit/{id}', [PropertyController::class, 'edit'])->name('property.edit');
    //property Routes End


   
    
    //Appartment Routes start
    Route::get('/appartment/create', [AppartmentController::class, 'create'])->name('appartment.create');
    Route::post('/appartment/store', [AppartmentController::class, 'store'])->name('appartment.store');
    Route::get('/appartment/edit/{id}', [AppartmentController::class, 'edit'])->name('appartment.edit');
    //property Routes End
    
    //Device Routes Start
     Route::get('/devices', [SensorDeviceController::class, 'index'])->name('device.index');
     Route::get('/device/create', [SensorDeviceController::class, 'create'])->name('device.create');
     Route::post('/device/store', [SensorDeviceController::class, 'store'])->name('device.store');
     Route::get('/device/edit/{id}', [SensorDeviceController::class, 'edit'])->name('device.edit');
    //Device Routes End
 
    //User Routes Start
     Route::get('/users', [UserController::class, 'index'])->name('user.index');
     Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
     Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
     Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    //User Routes End

}); 


// PROPERTY OWNER ROUTES
Route::prefix('property-owner')->middleware(['auth', 'PropertyOwner'])->group(function () {
    Route::get('/dashboard', [PropertyOwnerController::class, 'index'])->name('propertyowner.dashboard');
    Route::get('/property-detail/{id}', [PropertyOwnerController::class, 'property_detail'])->name('propertyowner.property.detail');
    Route::get('/appartment-detail/{id}', [PropertyOwnerController::class, 'appartment_detail'])->name('propertyowner.appartment.detail');

    //Appartment Routes Start
    Route::get('/appartment/create', [AppartmentController::class, 'create'])->name('propertyowner.appartment.create');
    Route::post('/appartment/store', [AppartmentController::class, 'store'])->name('propertyowner.appartment.store');
    Route::get('/appartment/edit/{id}', [AppartmentController::class, 'edit'])->name('propertyowner.appartment.edit');
    //Appartment Routes End

     //Device Routes Start
     Route::get('/devices', [SensorDeviceController::class, 'index'])->name('propertyowner.device.index');
     Route::get('/device/create', [SensorDeviceController::class, 'create'])->name('propertyowner.device.create');
     Route::post('/device/store', [SensorDeviceController::class, 'store'])->name('propertyowner.device.store');
     Route::get('/device/edit/{id}', [SensorDeviceController::class, 'edit'])->name('propertyowner.device.edit');
    //Device Routes End


});


// // FLAT OWNER ROUTES
Route::prefix('flat-owner')->middleware(['auth', 'Flatowner'])->group(function () {
    Route::get('/dashboard', [AppartmentOwnerController::class, 'index'])->name('flatowner.dashboard');
    Route::get('/property-detail/{id}', [AppartmentOwnerController::class, 'property_detail'])->name('flatowner.property.detail');
    Route::get('/appartment-detail/{id}', [AppartmentOwnerController::class, 'appartment_detail'])->name('flatowner.appartment.detail');

    //Device Routes Start
    Route::get('/device/create', [SensorDeviceController::class, 'create'])->name('flatowner.device.create');
    Route::post('/device/store', [SensorDeviceController::class, 'store'])->name('flatowner.device.store');
    Route::get('/device/edit/{id}', [SensorDeviceController::class, 'edit'])->name('flatowner.device.edit');
    //Device Routes End
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');


// Route::middleware(['auth'])->group(function () {
    Route::any('/webhook/{code}', [SensorDeviceController::class, 'webhook'])->name('webhook');
    Route::get('/user/password/{id}', [UserController::class, 'cofigure_password'])->name('user.cofigure_password');
    Route::post('/user/password', [UserController::class, 'cofigure_password_post'])->name('user.cofigure_password.post');
     // Ajax Request
     Route::post('/water_ajax', [AdminController::class, 'water_ajax'])->name('water.ajax')->middleware('auth');
// });