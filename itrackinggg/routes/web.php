<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', function () {
    return view('home');
})->name('home');

// Add more routes as needed
Route::get('/profile', function () {
    return view('profile'); // Create profile.blade.php similarly
})->name('profile');

Route::get('/settings', function () {
    return view('settings'); // Create settings.blade.php similarly
})->name('settings');

Route::post('/logout', function () {
    // Handle logout logic here
    return redirect()->route('home');
})->name('logout');
use App\Http\Controllers\ItemController;

Route::resource('items', ItemController::class)->except(['show']);

Route::get('items/archived', [ItemController::class, 'archivedItems'])->name('items.archived');
Route::post('items/{item}/archive', [ItemController::class, 'archive'])->name('items.archive');
Route::post('items/{item}/restore', [ItemController::class, 'restore'])->name('items.restore');
Route::delete('items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');


use App\Http\Controllers\PersonnelController;

Route::resource('personnels', PersonnelController::class)->except(['show']);
Route::post('personnels/{personnel}/restore', [PersonnelController::class, 'restore'])->name('personnels.restore');
Route::get('personnels/archived', [PersonnelController::class, 'archived'])->name('personnels.archived'); // New route

use App\Http\Controllers\EquipmentController;

// Resource route for equipment excluding show
Route::resource('equipments', EquipmentController::class)->except(['show']);

// Other routes
Route::post('equipments/{equipment}/restore', [EquipmentController::class, 'restore'])->name('equipments.restore');
Route::get('equipments/archived', [EquipmentController::class, 'archived'])->name('equipments.archived');

// Route for showing the change personnel form
Route::get('equipments/{equipment}/change-personnel', [EquipmentController::class, 'changePersonnel'])->name('equipments.changePersonnel');

// Route for confirming the personnel change
Route::post('equipments/{equipment}/confirm-change-personnel', [EquipmentController::class, 'confirmChangePersonnel'])->name('equipments.confirmChangePersonnel');

// Route for updating the responsible personnel
Route::put('equipments/{equipment}/update-personnel', [EquipmentController::class, 'updatePersonnel'])->name('equipments.updatePersonnel');



// Route to show the borrow form
Route::get('equipments/{equipment}/borrow', [EquipmentController::class, 'showBorrowForm'])->name('equipments.borrow');

// Route to handle borrow submission
Route::post('equipments/store-borrow', [EquipmentController::class, 'storeBorrow'])->name('equipments.store-borrow');

use App\Http\Controllers\BorrowLogController;

Route::get('borrow-logs', [BorrowLogController::class, 'index'])->name('borrow-logs.index');
Route::post('borrowlogs/{log}/return', [BorrowLogController::class, 'return'])->name('borrowlogs.return');
Route::resource('borrowlogs', BorrowLogController::class)->only(['index']);



// Route to view condemned equipment
Route::get('/equipments/condemned', [EquipmentController::class, 'viewCondemned'])->name('equipments.condemned');

// Route to condemn equipment (using PUT method)
Route::put('/equipments/{id}/condemn', [EquipmentController::class, 'condemn'])->name('equipments.condemn');

// Route to update equipment (using PUT method)
Route::put('/equipments/{equipment}', [EquipmentController::class, 'update'])->name('equipments.update');


use App\Http\Controllers\UserLogController;

Route::get('/user-logs', [UserLogController::class, 'index'])->name('user.logs.index');

require __DIR__.'/auth.php';
