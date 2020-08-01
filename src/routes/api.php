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

Route::post('register', 'Api\RegisterController@register')->name('register');
Route::post('login', 'Api\RegisterController@login')->name('login');

Route::middleware('auth:api')->group( function () {
    // products routes 
    Route::get('products', 'Api\ProductController@index')->name('products.all');
    Route::get('products/{id}', 'Api\ProductController@show')->name('products.show');

    Route::middleware('validator:Product,create')->group( function () {
    	Route::post('products', 'Api\ProductController@store')->name('products.create');
    });

    // wihlists routes
    Route::middleware('validator:Wishlist,create')->group( function () {
    	Route::post('wishlists', 'Api\WishlistController@store')->name('wishlists.create');
    });
    Route::middleware('validator:Wishlist,addProduct')->group( function () {
    	Route::post('wishlists/add', 'Api\WishlistController@addProduct')->name('wishlists.add.product');
    });
});
