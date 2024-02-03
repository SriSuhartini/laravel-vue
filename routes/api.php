<?php

use App\Http\Controllers\ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('product')->group(function () {
    Route::get('/', [ApiProductController::class, 'index'])->name('api.product.index');
    Route::get('/{id}', [ApiProductController::class, 'show'])->name('api.product.show');
    Route::post('/', [ApiProductController::class, 'store'])->name('api.product.store');
    Route::put('/{id}', [ApiProductController::class, 'update'])->name('api.product.update');
    Route::delete('/{id}', [ApiProductController::class, 'destroy'])->name('api.product.destroy');
});
