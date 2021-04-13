<?php

use Illuminate\Http\Request;

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
// Lấy danh sách sản phẩm
Route::get('/products', 'Api\ProductController@index')->name('products.index');

// Lấy thông tin sản phẩm theo id
Route::get('products/{id}', 'Api\ProductController@show')->name('products.show');

// Thêm sản phẩm mới
Route::post('/products/create', 'Api\ProductController@store')->name('products.store');

// Cập nhật thông tin sản phẩm theo id
# Sử dụng put nếu cập nhật toàn bộ các trường
Route::put('products/{id}', 'Api\ProductController@update')->name('products.update');
# Sử dụng patch nếu cập nhật 1 vài trường
Route::patch('products/{id}', 'Api\ProductController@update')->name('products.update');

// Xóa sản phẩm theo id
Route::delete('/products/delete/{id}', 'Api\ProductController@destroy')->name('products.destroy');

Route::post('/post/create', 'PostController@store');
Route::get('/post/edit/{id}', 'PostController@edit');
Route::post('/post/update/{id}', 'PostController@update');
Route::delete('/post/delete/{id}', 'PostController@delete');
Route::get('/posts', 'PostController@index');

Route::get('/product', 'ProductController@index');
Route::post('/product/create', 'ProductController@store');
Route::delete('/product/delete/{id}', 'ProductController@delete');
Route::get('/product/edit/{id}', 'ProductController@edit');
Route::post('/product/update/{id}', 'ProductController@update');
