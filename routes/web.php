<?php

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

Route::get('/', 'HomeController@index')->name('home-page');

Route::get('/products/{param?}', 'ProductController@getAllProducts')->name('products-page');
//Route::get('/products/{param?}', 'ProductController@getAllProducts2')->name('products-page-2');
//Route::get('/products/{param?}/{param2?}', 'ProductController@getAllProducts')->name('products-page');

Route::get('/products/{collection?}/{category?}', 'ProductController@getByIdCollectionAndIdCategory');
Route::get('/search', 'ProductController@searchProducts')->name('search-products');

Route::get('/sale/{param?}', 'ProductController@getAllProductsOnSale')->name('sale-page');
Route::get('/sale/{collection?}/{category?}', 'ProductController@getSaleProductsByIdCollectionAndIdCategory');
Route::get('/search/sale', 'ProductController@searchProductsOnSale')->name('search-sale-products');

Route::get('/cart', 'CartController@index')->name('cart-page');
Route::get('/cart/{id}', 'CartController@addToCart')->name('add-to-cart');
Route::get('/cart/{id}/delete', 'CartController@deleteFromCart')->name('delete-from-cart');
Route::post('/cart', 'CartController@insertOrders')->name("insert-orders");

Route::get('/author', 'HomeController@author')->name("author-page");

Route::get('/contact', 'ContactController@index')->name('contact-page');
Route::post('/contact', 'ContactController@sendEmail');

Route::get('/login', 'LoginController@login')->name('login-form');
Route::post('/login', 'LoginController@doLogin');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/registration', 'LoginController@register')->name('registration-form');
Route::post('/registration', 'LoginController@doRegister');

// ADMIN
Route::group(['middleware' => 'admin'], function (){
    Route::get('/admin/users', 'Admin\UserController@index')->name('users-index');
    Route::get('/admin/users/create', 'Admin\UserController@create')->name('users-create');
    Route::post('/admin/users', 'Admin\UserController@store')->name('users-store');
    Route::get('/admin/users/{id}', 'Admin\UserController@show')->name('users-show');
    Route::post('/admin/users/{id}/update', 'Admin\UserController@update')->name('users-update');
    Route::get('/admin/users/{id}/delete', 'Admin\UserController@destroy')->name('users-destroy');

    Route::get('/admin/roles', 'Admin\RoleController@index')->name('roles-index');
    Route::get('/admin/roles/create', 'Admin\RoleController@create')->name('roles-create');
    Route::post('/admin/roles', 'Admin\RoleController@store')->name('roles-store');
    Route::get('/admin/roles/{id}', 'Admin\RoleController@show')->name('roles-show');
    Route::post('/admin/roles/{id}/update', 'Admin\RoleController@update')->name('roles-update');
    Route::get('/admin/roles/{id}/delete', 'Admin\RoleController@destroy')->name('roles-destroy');

    Route::get('/admin/products', 'Admin\ProductController@index')->name('products-index');
    Route::get('/admin/products/create', 'Admin\ProductController@create')->name('products-create');
    Route::post('/admin/products', 'Admin\ProductController@store')->name('products-store');
    Route::get('/admin/products/{id}', 'Admin\ProductController@show')->name('products-show');
    Route::post('/admin/products/{id}/update', 'Admin\ProductController@update')->name('products-update');
    Route::get('/admin/products/{id}/delete', 'Admin\ProductController@destroy')->name('products-destroy');
    Route::get('/admin/products/search', 'Admin\ProductController@searchProductsAdmin')->name('search-admin-products');

    Route::get('/admin/collections', 'Admin\CollectionController@index')->name('collections-index');
    Route::get('/admin/collections/create', 'Admin\CollectionController@create')->name('collections-create');
    Route::post('/admin/collections', 'Admin\CollectionController@store')->name('collections-store');
    Route::get('/admin/collections/{id}', 'Admin\CollectionController@show')->name('collections-show');
    Route::post('/admin/collections/{id}/update', 'Admin\CollectionController@update')->name('collections-update');
    Route::get('/admin/collections/{id}/delete', 'Admin\CollectionController@destroy')->name('collections-destroy');

    Route::get('/admin/categories', 'Admin\CategoryController@index')->name('categories-index');
    Route::get('/admin/categories/create', 'Admin\CategoryController@create')->name('categories-create');
    Route::post('/admin/categories', 'Admin\CategoryController@store')->name('categories-store');
    Route::get('/admin/categories/{id}', 'Admin\CategoryController@show')->name('categories-show');
    Route::post('/admin/categories/{id}/update', 'Admin\CategoryController@update')->name('categories-update');
    Route::get('/admin/categories/{id}/delete', 'Admin\CategoryController@destroy')->name('categories-destroy');

    Route::get('/admin/customers', 'Admin\CustomerController@index')->name('customers-index');
    Route::get('/admin/customers/create', 'Admin\CustomerController@create')->name('customers-create');
    Route::post('/admin/customers', 'Admin\CustomerController@store')->name('customers-store');
    Route::get('/admin/customers/{id}', 'Admin\CustomerController@show')->name('customers-show');
    Route::post('/admin/customers/{id}/update', 'Admin\CustomerController@update')->name('customers-update');
    Route::get('/admin/customers/{id}/delete', 'Admin\CustomerController@destroy')->name('customers-destroy');

    Route::get('/admin/orders', 'Admin\CartController@index')->name('orders-index');
    Route::get('/admin/orders/create', 'Admin\CartController@create')->name('orders-create');
    Route::post('/admin/orders', 'Admin\CartController@store')->name('orders-store');
    Route::get('/admin/orders/{id}', 'Admin\CartController@show')->name('orders-show');
    Route::post('/admin/orders/{id}/update', 'Admin\CartController@update')->name('orders-update');
    Route::get('/admin/orders/{id}/delete', 'Admin\CartController@destroy')->name('orders-destroy');

});

