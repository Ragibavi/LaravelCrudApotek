<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicineController;

Route::get('/', function () {
    return view('medicine.home');
});

Route::prefix('/medicine')->name('medicine.')->group(function(){
    Route::get('/home', [MedicineController::class, 'home'])->name('home');
    Route::get('/create', [MedicineController::class, 'create'])->name('create');
    Route::get('/adminStock', [MedicineController::class, 'adminStock'])->name('adminStock');
    Route::post('/store', [MedicineController::class, 'store'])->name('store');
    Route::get('/table', [MedicineController::class, 'table'])->name('table');
    Route::get('/{id}', [MedicineController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [MedicineController::class, 'update'])->name('update');
    Route::delete('/{id}', [MedicineController::class, 'destroy'])->name('destroy');
    Route::get('/editStock/{id}', [MedicineController::class, 'editStock'])->name('editStock');
});

Route::prefix('/user')->name('user.')->group(function(){
    Route::get('/table', [UserController::class, 'table'])->name('table');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [UserController::class, 'update'])->name('update');
});


