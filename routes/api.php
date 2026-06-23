<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AppointmentsController;
use App\Http\Controllers\Admin\ProductsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/appointments', [AppointmentsController::class, 'store']);

Route::get('/appointments', [AppointmentsController::class, 'index']);
// ── Prodotti (pubblico per il frontend Vue) ──
Route::get('/products', [ProductsController::class, 'apiIndex']);