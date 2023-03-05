<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\API\UserController;

Route::prefix('user')->group(function () {
    // Route::post('/insert', [UserController::class, 'insert'])->name('user.insert');
    Route::get('/all', [UserController::class, 'all'])->name('user.all');
    Route::get('/paging', [UserController::class, 'paging'])->name('user.all');
    // Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/find/{id}', [UserController::class, 'find'])->name('user.find');
    // Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
});
