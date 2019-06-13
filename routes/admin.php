<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "web" middleware group. Enjoy building your Admin!
|
*/

Route::get('', [
    'as' => 'admin.dashboard.index',
    'uses' => 'DashboardController@index'
]);

Route::group(['prefix' => 'products'], function() {
    Route::get('', [
        'as' => 'admin.products.index',
        'uses' => 'ProductController@index'
    ]);
    Route::get('create', [
        'as' => 'admin.products.create',
        'uses' => 'ProductController@create'
    ]);
    Route::post('', [
        'as' => 'admin.products.store',
        'uses' => 'ProductController@store'
    ]);
    Route::get('{id}/edit', [
        'as' => 'admin.products.edit',
        'uses' => 'ProductController@edit'
    ]);
    Route::put('{id}', [
        'as' => 'admin.products.update',
        'uses' => 'ProductController@update'
    ]);
    Route::delete('{id}', [
        'as' => 'admin.products.destroy',
        'uses' => 'ProductController@destroy'
    ]);
});

Route::resource('categories', 'CategoryController', [
    'parameters' => [
        'categories' => 'id'
    ],
    'except' => 'show',
    'as' => 'admin'
]);

Route::group(['prefix' => 'orders'], function() {
    Route::get('', [
        'as' => 'admin.orders.index',
        'uses' => 'OrderController@index'
    ]);
    Route::get('processed', [
        'as' => 'admin.orders.processed',
        'uses' => 'OrderController@processed'
    ]);
    Route::get('{id}/edit', [
        'as' => 'admin.orders.edit',
        'uses' => 'OrderController@edit'
    ]);
    Route::put('{id}', [
        'as' => 'admin.orders.update',
        'uses' => 'OrderController@update'
    ]);
});

Route::resource('users', 'UserController', [
    'parameters' => [
        'users' => 'id'
    ],
    'except' => 'show',
    'as' => 'admin'
]);