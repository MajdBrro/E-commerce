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
    Route::group(['namespace'=>'App\Http\Controllers\Dashboard'/*,'middleware'=>'auth:admin'*/, 'prefix'=>'admin'],function(){
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
            Route::get('create','MainCategoriesController@create')-> name('admin.maincategories.create');
            Route::put('store','MainCategoriesController@store')-> name('admin.maincategories.store');
            Route::get('edit/{id}','MainCategoriesController@edit')-> name('admin.maincategories.edit');
            Route::put('update/{id}','MainCategoriesController@update')-> name('admin.maincategories.update');
            Route::delete('delete/{id}','MainCategoriesController@delete')-> name('admin.maincategories.delete');
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
         ################################## Brands routes ######################################
         Route::group(['prefix' => 'brands', 'Middleware'=> 'can:brands'], function () {
            Route::get('/', 'BrandsController@index')->name('admin.brands');
            Route::get('create', 'BrandsController@create')->name('admin.brands.create');
            Route::put('store', 'BrandsController@store')->name('admin.brands.store');
            Route::get('edit/{id}', 'BrandsController@edit')->name('admin.brands.edit');
            Route::put('update/{id}', 'BrandsController@update')->name('admin.brands.update');
            Route::delete('delete/{id}', 'BrandsController@delete')->name('admin.brands.delete');
        });
############################################################### end Brands    #######################################

############################################################### Tags routes ######################################
        Route::group(['prefix' => 'tags', 'Middleware'=> 'can:tags'], function () {
            Route::get('/', 'TagsController@index')->name('admin.tags');
            Route::get('create', 'TagsController@create')->name('admin.tags.create');
            Route::put('store', 'TagsController@store')->name('admin.tags.store');
            Route::get('edit/{id}', 'TagsController@edit')->name('admin.tags.edit');
            Route::put('update/{id}', 'TagsController@update')->name('admin.tags.update');
            Route::delete('delete/{id}', 'TagsController@delete')->name('admin.tags.delete');
        });
############################################################### end Tags #######################################
############################################################### Products routes ######################################
    Route::group(['prefix' => 'products', 'Middleware'=> 'can:products'], function () {
    // ----------------------------------------------------------------------------------------------    
        Route::get('/', 'ProductsController@index')->name('admin.products');
    // ----------------------------------------------------------------------------------------------    
        Route::get('create-general-information', 'ProductsController@create')->name('admin.products.general.create');
        Route::put('store-general-information', 'ProductsController@store')->name('admin.products.general.store');
        Route::get('edit-general-information/{id}', 'ProductsController@edit')->name('admin.products.general.edit');
        Route::put('update-general-information', 'ProductsController@update')->name('admin.products.general.update');
    // ----------------------------------------------------------------------------------------------    
        Route::get('price/{id}', 'ProductsController@getPrice')->name('admin.products.price');
        Route::put('price', 'ProductsController@saveProductPrice')->name('admin.products.price.store');
    // ----------------------------------------------------------------------------------------------   
        Route::get('stock/{id}', 'ProductsController@getStock')->name('admin.products.stock');
        Route::put('stock', 'ProductsController@saveProductStock')->name('admin.products.stock.store'); 
    // ---------------------------------------------------------------------------------------------- 
        Route::get('images/{id}', 'ProductsController@addImages')->name('admin.products.images');
        Route::post('images', 'ProductsController@saveProductImages')->name('admin.products.images.store');
        Route::post('images/db', 'ProductsController@saveProductImagesDB')->name('admin.products.images.store.db');
    // ---------------------------------------------------------------------------------------------- 
        Route::delete('delete/{id}', 'ProductsController@delete')->name('admin.products.delete');        
    });
############################################################### Products routes ######################################
################################## attrributes routes ######################################
 Route::group(['prefix' => 'attributes','Middleware'=> 'can:attributes'], function () {
    Route::get('/', 'AttributesController@index')->name('admin.attributes');
    Route::get('create', 'AttributesController@create')->name('admin.attributes.create');
    Route::post('store', 'AttributesController@store')->name('admin.attributes.store');
    Route::get('delete/{id}', 'AttributesController@destroy')->name('admin.attributes.delete');
    Route::get('edit/{id}', 'AttributesController@edit')->name('admin.attributes.edit');
    Route::PUT('update/{id}', 'AttributesController@update')->name('admin.attributes.update');
});
################################## end attributes    #######################################
################################## options routes ######################################
 Route::group(['prefix' => 'options','Middleware'=> 'can:options'], function () {
    Route::get('/', 'OptionsController@index')->name('admin.options');
    Route::get('create', 'OptionsController@create')->name('admin.options.create');
    Route::post('store', 'OptionsController@store')->name('admin.options.store');
    Route::get('delete/{id}', 'OptionsController@destroy')->name('admin.options.delete');
    Route::get('edit/{id}', 'OptionsController@edit')->name('admin.options.edit');
    Route::PUT('update/{id}', 'OptionsController@update')->name('admin.options.update');
});
################################## end options    #######################################
    });

    Route::group(['namespace'=>'App\Http\Controllers\Dashboard','middleware'=>'guest:admin', 'prefix'=>'admin'],function(){

        Route::get('login','LoginController@login') -> name('admin.login');
        Route::post('savelogin' , 'LoginController@checkAdminLogin')-> name('save.admin.login');
    });

});





