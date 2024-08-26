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
        ############################# Categories Routes ############################################################
        route::group(['prefix'=>'main_categories'],function(){
            Route::get('/','MainCategoriesController@index')-> name('admin.maincategories');
            Route::get('edit/{id}','MainCategoriesController@edit')-> name('admin.maincategories.edit');
            Route::patch('update/{id}','MainCategoriesController@update')-> name('admin.maincategories.update');
            Route::get('create','MainCategoriesController@create')-> name('admin.maincategories.create');
            Route::patch('store','MainCategoriesController@store')-> name('admin.maincategories.store');
            Route::get('delete/{id}','MainCategoriesController@delete')-> name('admin.maincategories.delete');
        });

        ############################# Categories Routes ############################################################
        ############################# SubCategories Routes ############################################################
        // route::group(['prefix'=>'Sub_categories'],function(){
        //     route::post('/','SubCategoriesController@index')->name('admin.subcategories');
        //     route::post('create','SubCategoriesController@create')->name('admin.subcategories.create');
        //     route::post('store','SubCategoriesController@store')->name('admin.subcategories.store');
        //     route::post('edit/{id}','SubCategoriesController@edit')->name('admin.subcategories.edit');
        //     route::post('update/{id}','SubCategoriesController@update')->name('admin.subcategories.update');
        //     route::post('delete/{id}','SubCategoriesController@delete')->name('admin.subcategories.delete');
        // });

        ############################# SubCategories Routes ############################################################
    });

    Route::group(['namespace'=>'App\Http\Controllers\Dashboard','middleware'=>'guest:admin', 'prefix'=>'admin'],function(){

        Route::get('login','LoginController@login') -> name('admin.login');
        Route::post('savelogin' , 'LoginController@checkAdminLogin')-> name('save.admin.login');
    });

});





