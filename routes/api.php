<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::middleware('auth:api')->get('/absensi', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [
    'uses' => 'AuthController@api_login'
]);
Route::post('logout', [
    'uses' => 'AuthController@api_logout'
]);
Route::post('user', [
    'uses' => 'GuruController@user',
    'middleware' => 'auth:api'
]);
Route::post('absensi', [
    'uses' => 'AbsensiController@store',
    'middleware' => 'auth:api'
]);

Route::post('siswa', [
    'uses' => 'SiswaController@api_index',
    'middleware' => 'auth:api'
]);
Route::post('guru', [
    'uses' => 'GuruController@api_index',
    'middleware' => 'auth:api'
]);

Route::post('absensi-data', [
    'uses' => 'AbsensiController@data',
    'middleware' => 'auth:api'
]);