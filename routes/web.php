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
//路由分组,以下入口必须是登陆后才能访问
Route::middleware(['checkLogin'])->group(function () {
	Route::get('/', function () {
	    return view('welcome');
	});
	Route::get('loginout','Auth\LoginController@loginout', function () {
	});
	Route::get('user','Auth\LoginController@userCenter');
	Route::get('user/top','Auth\LoginController@userTop');
	Route::get('user/left','Auth\LoginController@userLeft');
	Route::get('user/right','Auth\LoginController@userRight');
	Route::get('boke/bk_list','Boke\BokeController@bk_list');
	Route::get('boke/bk_add','Boke\BokeController@bk_add');
	Route::get('boke/layui_bklist','Boke\BokeController@layui_bklist');
	Route::get('boke/layui_bkedit','Boke\BokeController@layui_bkedit');	
	//Route::get('boke/getarticleslist','Boke\BokeController@getArticlesList');
});
	//单独使用中间件来检查是否登陆
	// Route::get('/', ['middleware' => 'checkLogin', function () {
 	//    	return view('welcome');
	// }]);

	// Route::get('login',['uses'=>'LoginController@Index'], function () {
	//     return view('login');
	// });
	//或者以下写法都可以
	Route::get('login','Auth\LoginController@index');
	Route::post('store','Auth\LoginController@store');
	Route::post('boke/layui_bklist','Boke\BokeController@layui_bklist');
	Route::get('boke/bk_list','Boke\BokeController@bk_list');
	Route::post('boke/layui_bkdel','Boke\BokeController@layui_bkdel');
	Route::post('boke/layui_bksave','Boke\BokeController@layui_bksave');
	//Route::get('boke/layui_bkedit','Boke\BokeController@layui_bkedit');
	
	//Route::get('store','Auth\LoginController@store');
	// Route::put('isLogin','Controller@isLogin', function () {
	// });
	//此方法是直接访问view下的login
	// Route::get('login', function () {
	//     return view('login');
	// });



