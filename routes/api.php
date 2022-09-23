<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\CategoryController;

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

Route::apiResource('tags', TagController::class);
Route::apiResource('categories', CategoryController::class);
Route::get('ads/filter', [AdController::class, 'filter']);
Route::get('ads/advertiser/{advertiser}', [AdController::class, 'advertisersAds']);
Route::get('ads/{ad}', [AdController::class, 'show']);
