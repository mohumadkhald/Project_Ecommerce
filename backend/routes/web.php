<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

require __DIR__ . '/auth.php';


route::get('/redirect', [AdminController::class, 'redirect']);
route::get('/view_category', [AdminController::class, 'view_category']);
route::get('/cat_delete/{id}', [AdminController::class, 'cat_delete']);
route::get('/cat_update/{id}', [AdminController::class, 'cat_update']);
route::post('/add_category', [AdminController::class, 'add_category']);

route::get('/view_product', [AdminController::class, 'view_product']);

route::get('/product_delete/{id}', [AdminController::class, 'product_delete']);

route::get('/view_brand', [AdminController::class, 'view_brand']);

route::post('/add_brand', [AdminController::class, 'add_brand']);

route::get('/brand_delete/{id}', [AdminController::class, 'brand_delete']);

route::get('/view_users', [AdminController::class, 'view_users']);
route::get('/user_delete/{id}', [AdminController::class, 'user_delete']);
