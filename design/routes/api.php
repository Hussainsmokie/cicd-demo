<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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


// Route::post('/getDesignData', [ApiController::class, 'getDesignData'])->name('getDesignData');

Route::post('/store', [ApiController::class, 'store'])->name('store');
Route::get('/get_users', [ApiController::class, 'get_users'])->name('get_users');
Route::get('/edit_users/{id}', [ApiController::class, 'edit_users'])->name('edit_users');
Route::post('/update_user/{id}', [ApiController::class, 'update_user'])->name('update_user');
Route::post('/delete_user/{id}', [ApiController::class, 'delete_user'])->name('delete_user');

