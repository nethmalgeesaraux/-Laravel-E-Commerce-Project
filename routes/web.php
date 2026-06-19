<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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

    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/categories/add', [AdminController::class, 'categoryAdd'])->name('admin.category.add');
    Route::post('/admin/categories', [AdminController::class, 'categoryStore'])->name('admin.categories.store');
    Route::get('/admin/categories/edit/{id}', [AdminController::class, 'categoryEdit'])->name('admin.category.edit');
    Route::put('/admin/categories/{id}', [AdminController::class, 'categoryUpdate'])->name('admin.category.update');
    Route::delete('/admin/categories/{id}', [AdminController::class, 'categoryDestroy'])->name('admin.category.destroy');

    Route::get('/admin/products', [ProductController::class, 'products'])->name('admin.products');
    Route::get('/admin/products/add', [ProductController::class, 'create'])->name('admin.product.add');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    // Admin user management
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{id}', [AdminController::class, 'userShow'])->name('admin.user.show');

    // Admin orders (safe if orders table doesn't exist yet)
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/orders/{id}', [AdminController::class, 'orderShow'])->name('admin.order.show');

    // Admin reviews
    Route::get('/admin/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::delete('/admin/reviews/{id}', [AdminController::class, 'reviewDestroy'])->name('admin.review.destroy');

    // Admin settings
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings', [AdminController::class, 'settingsUpdate'])->name('admin.settings.update');
});


require __DIR__.'/auth.php';
