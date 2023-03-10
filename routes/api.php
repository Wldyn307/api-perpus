<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthC;
use App\Http\Controllers\bukuC;
use App\Http\Controllers\UserC;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\peminjamanC;
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

Route::get('/about', function () {
    return 'Waliyudin Helmi dan Maruf Hartanto';
});

Route::apiResource('/buku', bukuC::class);

Route::apiResource('/peminjaman', peminjamanC::class)->middleware(['auth:sanctum']);

route::post('/login',[AuthC::class,'login']);

Route::apiResource('/user', UserC::class)->middleware(['auth:sanctum']);

route::post('/login',[AuthC::class,'login']);


