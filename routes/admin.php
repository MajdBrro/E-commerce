<?php

use App\Http\Controllers\Dashboard\LoginController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
    Route::group(['namespace'=>'App\Http\Controllers\Dashboard','middleware'=>'auth:admin', 'prefix'=>'admin'],function(){
        route::get('/',function(){
            return 'welcome to admin';
        });
        route::get('dashboard','DashboardController@index') -> name('admin.dashboard');
        Route::post('logout','LoginController@logout')-> name('admin.logout');

        ############################# Settings Routes ############################################################
        route::group(['prefix'=>'settings'],function(){
            Route::get('shipping-methods/{type}','SettingsController@editShippingMethods')-> name('edit.shipping.methods');
            Route::post('shipping-methods/{id}','SettingsController@updateShippingMethods')-> name('update.shippings.methods');
        });
        ############################# Settings Routes ############################################################
    });

    Route::group(['namespace'=>'App\Http\Controllers\Dashboard','middleware'=>'guest:admin', 'prefix'=>'admin'],function(){

        Route::get('login','LoginController@login') -> name('admin.login');
        Route::post('savelogin' , 'LoginController@checkAdminLogin')-> name('save.admin.login');
    });

});





