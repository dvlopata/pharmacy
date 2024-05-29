<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Main'], function () {
    Route::get('/', 'IndexController')->name('main.index');

    Route::group(['prefix' => 'pharmacies'], function () {
        Route::get('/', 'PharmacyController')->name('main.pharmacy.index');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductController@index')->name('main.product.index');
        Route::post('/', 'ProductController@store')->name('main.product.store');
        Route::get('/subcategory/{subcategory}', 'ProductController@showSubCategory')->name('main.product.showSubCategory');
        Route::post('/search', 'ProductController@searchByName')->name('main.product.searchByName');
    });
    Route::group(['prefix' => 'carts'], function () {
        Route::post('/store', 'CartController@store')->name('main.cart.store');
        Route::get('/', 'CartController@index')->name('main.cart.index');
        Route::post('/update', 'CartController@updateElCart')->name('main.cart.updateElCart');
        Route::delete('/', 'CartController@deleteElFromCart')->name('main.cart.deleteElFromCart');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/create', 'OrderController@create')->name('main.order.create');
        Route::post('/', 'OrderController@store')->name('main.order.store');
        Route::get('/success', 'OrderController@success')->name('main.order.success');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Personal', 'prefix' => 'personal', 'middleware' => ['auth']], function () {
    Route::get('/', 'IndexController@index')->name('personal.main.index');
    Route::post('/{order}', 'IndexController@cancelOrder')->name('personal.main.cancelOrder');
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'IndexController@index')->name('admin.main.index');

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.category.index');
        Route::get('/create', 'CategoryController@create')->name('admin.category.create');
        Route::post('/', 'CategoryController@store')->name('admin.category.store');
        Route::get('/{category}', 'CategoryController@show')->name('admin.category.show');
        Route::get('/{category}/edit', 'CategoryController@edit')->name('admin.category.edit');
        Route::patch('/{category}', 'CategoryController@update')->name('admin.category.update');
    });

    Route::group(['prefix' => 'subCategories'], function () {
        Route::get('/', 'SubCategoryController@index')->name('admin.subCategory.index');
        Route::get('/create', 'SubCategoryController@create')->name('admin.subCategory.create');
        Route::post('/', 'SubCategoryController@store')->name('admin.subCategory.store');
        Route::get('/{subCategory}', 'SubCategoryController@show')->name('admin.subCategory.show');
        Route::get('/{subCategory}/edit', 'SubCategoryController@edit')->name('admin.subCategory.edit');
        Route::patch('/{subCategory}', 'SubCategoryController@update')->name('admin.subCategory.update');
    });

    Route::group(['prefix' => 'manufacturers'], function () {
        Route::get('/', 'ManufacturerController@index')->name('admin.manufacturer.index');
        Route::get('/create', 'ManufacturerController@create')->name('admin.manufacturer.create');
        Route::post('/', 'ManufacturerController@store')->name('admin.manufacturer.store');
        Route::get('/{manufacturer}', 'ManufacturerController@show')->name('admin.manufacturer.show');
        Route::get('/{manufacturer}/edit', 'ManufacturerController@edit')->name('admin.manufacturer.edit');
        Route::patch('/{manufacturer}', 'ManufacturerController@update')->name('admin.manufacturer.update');
        Route::delete('/{manufacturer}', 'ManufacturerController@delete')->name('admin.manufacturer.delete');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductController@index')->name('admin.product.index');
        Route::get('/create', 'ProductController@create')->name('admin.product.create');
        Route::post('/', 'ProductController@store')->name('admin.product.store');
        Route::get('/{product}', 'ProductController@show')->name('admin.product.show');
        Route::get('/{product}/edit', 'ProductController@edit')->name('admin.product.edit');
        Route::patch('/{product}', 'ProductController@update')->name('admin.product.update');
        Route::delete('/{product}', 'ProductController@delete')->name('admin.product.delete');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.index');
        Route::get('/create', 'UserController@create')->name('admin.user.create');
        Route::post('/', 'UserController@store')->name('admin.user.store');
        Route::get('/{user}', 'UserController@show')->name('admin.user.show');
        Route::get('/{user}/edit', 'UserController@edit')->name('admin.user.edit');
        Route::patch('/{user}', 'UserController@update')->name('admin.user.update');
        Route::delete('/{user}', 'UserController@delete')->name('admin.user.delete');
    });
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', 'OrderController@index')->name('admin.order.index');
        Route::get('/filter', 'OrderController@filter')->name('admin.order.filter');
        Route::get('/{order}', 'OrderController@show')->name('admin.order.show');
        Route::post('/accept/{order}', 'OrderController@acceptOrder')->name('admin.order.acceptOrder');
        Route::post('/cancel/{order}', 'OrderController@cancelOrder')->name('admin.order.cancelOrder');
        Route::post('/addWayBill/{order}', 'OrderController@addWayBill')->name('admin.order.addWayBill');
        Route::patch('/{order}', 'OrderController@update')->name('admin.order.update');
        Route::delete('/{order}', 'OrderController@delete')->name('admin.order.delete');
    });
    Route::group(['prefix' => 'pharmacies'], function () {
        Route::get('/', 'PharmacyController@index')->name('admin.pharmacy.index');
        Route::get('/create', 'PharmacyController@create')->name('admin.pharmacy.create');
        Route::post('/', 'PharmacyController@store')->name('admin.pharmacy.store');
        Route::get('/{pharmacy}', 'PharmacyController@show')->name('admin.pharmacy.show');
        Route::get('/{pharmacy}/edit', 'PharmacyController@edit')->name('admin.pharmacy.edit');
        Route::patch('/{pharmacy}', 'PharmacyController@update')->name('admin.pharmacy.update');
        Route::delete('/{pharmacy}', 'PharmacyController@delete')->name('admin.pharmacy.delete');
    });
});

Auth::routes();

