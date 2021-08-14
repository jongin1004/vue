<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoListController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todo', [ToDoListController::class, 'index']);

Route::get('/todo/Showdetail', [ToDoListController::class, 'detail']);

Route::get('/todo/complete', [ToDoListController::class, 'complete']);

Route::post('/todo/title', [ToDoListController::class, 'store']);

Route::post('/todo/updateDetail', [ToDoListController::class, 'updateDetail']);

