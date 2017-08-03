<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.show');
})->name('absensi.home');

Route::group(['prefix'=>'auth', 'middleware'=>'web'], function(){
    Route::get('login', [
        'as' => 'login',
        'uses' => 'AuthController@login'
    ]);
    Route::post('login', [
        'as' => 'login',
        'uses' => 'AuthController@prosesLogin'
    ]);
    Route::get('logout', [
        'as' => 'logout',
        'uses' => 'AuthController@logout'
    ]);
});

Route::group(['middleware'=>['web', 'auth'], 'as'=> 'home'], function(){
    Route::get('dasboard', [
        'as' => '.dashboard',
        'uses' => 'HomeController@dashboard'
    ]);
});

Route::get('excel', 'AbsensiController@excel');

Route::resource('absensi', 'AbsensiController', ['middleware'=>'auth']);
Route::resource('siswa', 'SiswaController', ['middleware'=>'auth']);
Route::resource('guru', 'GuruController', ['middleware'=>'auth']);
Route::resource('kelas', 'KelasController', ['middleware'=>'auth']);