<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AppointmentsController;
use App\Http\Controllers\Admin\ProductsController;

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
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('admin/appointments', AppointmentsController::class);

Route::get('/admin/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');

Route::get('/admin/appointments/{appointment}/edit', [AppointmentsController::class, 'edit'])->name('appointments.edit');

Route::get('/admin/appointments/create', [AppointmentsController::class, 'create'])->name('appointments.create');

Route::post('/admin/appointments', [AppointmentsController::class, 'store'])->name('appointments.store');

Route::get('/admin/appointments/show/{date}', [AppointmentsController::class, 'showByDate'])->name('appointments.showByDate');
Route::delete('/admin/appointments/{appointment}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');


require __DIR__.'/auth.php';
// ── Prodotti ──
Route::get('/admin/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/admin/products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/admin/products', [ProductsController::class, 'store'])->name('products.store');
Route::get('/admin/products/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/admin/products/{product}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/admin/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
