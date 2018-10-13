<?php
/**
 * Created by PhpStorm.
 * User: ttt
 * Date: 2018/10/13
 * Time: 17:17
 */

Route::get('login','LoginController@showLoginForm')->name('admin-login');
Route::post('login','LoginController@login');
Route::get('logout','LoginController@logout');
Route::group(['middleware' => ['auth:admin']], function(){
    Route::get('/','IndexController@index');
});
