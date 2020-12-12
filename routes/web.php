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

// Route::prefix('spp')->group(function(){
    Auth::routes();

    Route::middleware(['auth:web'])->group(function(){
        Route::get('/', 'HomeController@index')->name('web.index');

        Route::get('pengaturan','HomeController@pengaturan')->name('pengaturan.index');
        Route::get('ubah-pengaturan','HomeController@editPengaturan')->name('pengaturan.edit');
        Route::post('ubah-pengaturan','HomeController@storePengaturan')->name('pengaturan.store');
    
        //Siswa
        Route::get('siswa','SiswaController@index')->name('siswa.index');
        Route::get('tambah-siswa','SiswaController@create')->name('siswa.create');
        Route::post('tambah-siswa', 'SiswaController@store')->name('siswa.store');
        Route::get('siswa/{siswa}/detail', 'SiswaController@show')->name('siswa.show');
        Route::get('siswa/{siswa}/ubah', 'SiswaController@edit')->name('siswa.edit');
        Route::post('siswa/{siswa}/ubah','SiswaController@update')->name('siswa.update');
        Route::post('siswa/{siswa}/hapus', 'SiswaController@destroy')->name('siswa.destroy');
    
        //Periode
        Route::get('periode','PeriodeController@index')->name('periode.index');
        Route::get('tambah-periode','PeriodeController@create')->name('periode.create');
        Route::post('tambah-periode', 'PeriodeController@store')->name('periode.store');
        Route::get('periode/{periode}/ubah', 'PeriodeController@edit')->name('periode.edit');
        Route::post('periode/{periode}/ubah','PeriodeController@update')->name('periode.update');
        Route::post('periode/{periode}/hapus', 'PeriodeController@destroy')->name('periode.destroy'); 
    
        //Kelas
        Route::get('kelas','KelasController@index')->name('kelas.index');
        Route::get('tambah-kelas','KelasController@create')->name('kelas.create');
        Route::post('tambah-kelas', 'KelasController@store')->name('kelas.store');
        Route::get('kelas/{kelas}/ubah', 'KelasController@edit')->name('kelas.edit');
        Route::post('kelas/{kelas}/ubah','KelasController@update')->name('kelas.update');
        Route::post('kelas/{kelas}/hapus', 'KelasController@destroy')->name('kelas.destroy');
    
        //Users
        Route::get('user','UserController@index')->name('user.index');
        Route::get('tambah-user','UserController@create')->name('user.create');
        Route::post('tambah-user', 'UserController@store')->name('user.store');
        Route::get('user/{user}/ubah', 'UserController@edit')->name('user.edit');
        Route::post('user/{user}/ubah','UserController@update')->name('user.update');
        Route::post('user/{user}/hapus', 'UserController@destroy')->name('user.destroy');
    
        //Menabung
        Route::get('tabungan', 'TabunganController@index')->name('tabungan.index');
        Route::post('menabung', 'TabunganController@menabung')->name('tabungan.store');
    });
// });




