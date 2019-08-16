<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/goods/goodsList', 'GoodsController@goodsList');    //商品列表
Route::get('/goods/goodsDesc', 'GoodsController@goodsDesc');    //商品详情
Route::post('/goods/goodsSku', 'GoodsController@goodsSku');    //商品sku

Route::post('/cart/addCart', 'CartController@addCart');         //加入购物车
Route::get('/cart/cartList', 'CartController@cartList');         //购物车列表
Route::post('/cart/cartUpt', 'CartController@cartUpt');         //改变购买数量
Route::post('/cart/cartDel', 'CartController@cartDel');         //改变购买数量

Route::post('/order/orderAdd', 'OrderController@orderAdd');         //生成订单
Route::get('/order/orderList', 'OrderController@orderList');         //订单列表

Route::get('/order/pay', 'PayController@pay');         //去支付
Route::get('/order/Alireturn', 'PayController@Alireturn');         //同步回调
Route::post('/order/notify', 'PayController@Alireturn');         //异步回调




Route::get('/test', 'Test\TestController@test');         //测试
