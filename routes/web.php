<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'index'])->name('home.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware([AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/brands', [AdminController::class, 'brands'])->name('admin.brands');
    Route::post('/admin/brands', [AdminController::class, 'brandStore'])->name('admin.brands.store');
    Route::get('/admin/brands/add', [AdminController::class, 'brandAdd'])->name('admin.brand.add');
    Route::get('/admin/brands/edit/{id}', [AdminController::class, 'brandEdit'])->name('admin.brand.edit');
    Route::delete('/admin/brands/{id}', [AdminController::class, 'brandDestroy'])->name('admin.brand.destroy');
});


require __DIR__.'/auth.php';
