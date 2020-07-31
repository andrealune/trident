<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\RegisterController@register');
Route::post('login', 'Api\RegisterController@login');

Route::middleware('auth:api')->group( function () {
    // products routes 
    Route::get('products', 'Api\ProductController@index');
    Route::get('products/{id}', 'Api\ProductController@show');

    Route::middleware('validator:Product,create')->group( function () {
    	Route::post('products', 'Api\ProductController@store');
    });

    // wihlists routes
    Route::middleware('validator:Wishlist,create')->group( function () {
    	Route::post('wishlists', 'Api\WishlistController@store')->name('wishlists.store');
    });
    Route::middleware('validator:Wishlist,addProduct')->group( function () {
    	Route::post('wishlists/add', 'Api\WishlistController@addProduct')->name('wishlists.add.product');
    });
});
