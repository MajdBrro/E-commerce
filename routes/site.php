
<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| site Routes
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
        'namespace'=> 'App\Http\Controllers\Site',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth'/*'VerifiedUser'*/ ]
    ], function(){


        // route::get('/', 'HomeController@home')->name('home');
        // route::get('category/{slug}', 'CategoryController@productsBySlug')->name('category');
        route::get('product/{slug}', 'ProductController@productsBySlug')->name('product.details');
        // Auth::routes();

        // Route::group([ 'middleware' => ['auth', 'VerifiedUser']], function () {
        //     // must be authenticated user and verified
        //     Route::get('profile', function () {
        //         return 'You Are Authenticated ';
        //     });
        // });
        // Route::group(['prefix' => 'cart'], function () {
        //     Route::get('/', 'CartController@getIndex')->name('site.cart.index');
        //     Route::post('/cart/add/{slug?}', 'CartController@postAdd')->name('site.cart.add');
        //     Route::post('/update/{slug}', 'CartController@postUpdate')->name('site.cart.update');
        //     Route::post('/update-all', 'CartController@postUpdateAll')->name('site.cart.update-all');
        // });

    // Route::group(['namespace' => 'Site'/*, 'middleware' => 'guest'*/], function () {
        //guest  user
        // Route::get('fat','PaymentController@fatoorah');
        // route::get('category/{slug}', 'CategoryController@productsBySlug')->name('category');
        // route::get('product/{slug}', 'ProductController@productsBySlug')->name('product.details');

    // Route::group(['namespace'=>'App\Http\Controllers\Site','middleware'=>'auth:web'], function(){
    //     Route::get('test',function(){
    //         return view('front.home');
    //         return 'you are authenticated';
    //     });
    // Route::get('test',function(){
    //     return 'dfsfsf';
    // });

    // });

});

