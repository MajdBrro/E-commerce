<?php

use App\Http\Controllers\Dashboard\LoginController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

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
Route::group(['namespace'=>'App\Http\Controllers\Dashboard','middleware'=>'auth:admin', 'prefix'=>'admin'],function(){
    route::get('/',function(){
        return 'welcome to admin';
    });
    route::get('dashboard','DashboardController@index') -> name('admin.dashboard');
});

Route::group(['namespace'=>'App\Http\Controllers\Dashboard','middleware'=>'guest:admin', 'prefix'=>'admin'],function(){

    Route::get('login','LoginController@login') -> name('admin.login');
    Route::post('savelogin' , 'LoginController@checkAdminLogin')-> name('save.admin.login');
});







