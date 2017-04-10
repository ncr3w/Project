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


/*
|--------------------------------------------------------------------------
| Staff Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', 'HomeController@index');


Route::group(['prefix' => 'staffview', 'namespace' => 'Staffview','middleware' => ['role:superadmin, role:admin']], function () {	
    Route::resource('brands', 'BrandsController');
    Route::resource('products', 'ProductsController');
    Route::resource('divisions', 'DivisionsController');   
});

Route::group(['prefix' => 'staffview','namespace' => 'Auth'],function(){
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
    Route::post('password/reset', 'ResetPasswordController@reset');
});



