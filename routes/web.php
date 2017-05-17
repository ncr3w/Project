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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/Browse', 'ProductViewController@index')->name('product.index');
Route::get('/Product/New/{article}/{name}', 'ProductViewController@newproduct')->name('product.new');
Route::get('/Product/Used/{article}/{name}/{id}', 'ProductViewController@usedproduct')->name('product.used');

Route::group(['prefix' => 'staffview', 'namespace' => 'Staffview','middleware' => ['role:superadmin, role:admin']], function () {	

	Route::get('/', 'HomeController@index');
	Route::get('roles/showpermission/{id}',[ 'uses' => 'RolesController@showpermission', 'as' => 'roles.showpermission']);
	Route::post('roles/editpermission/{id}',[ 'uses' => 'RolesController@editpermission', 'as' => 'roles.editpermission']);
	Route::get('invoices/success',[ 'uses' => 'InvoicesController@index_success', 'as' => 'invoices.index_success']);
	Route::get('invoices/{id}',[ 'uses' => 'InvoicesController@index_user', 'as' => 'invoices.index_user']);
	Route::get('invoices/fail',[ 'uses' => 'InvoicesController@index_fail', 'as' => 'invoices.index_fail']);
	Route::get('invoices/details/{id}',[ 'uses' => 'InvoicesController@details', 'as' => 'invoices.details']);
	Route::get('tickets/finished',[ 'uses' => 'TicketsController@index_finished', 'as' => 'tickets.index_finished']);
	Route::get('tickets/chat/{id}',[ 'uses' => 'TicketsController@chat', 'as' => 'tickets.chat']);
	Route::get('cutomers/balance/{id}',[ 'uses' => 'CustomersController@balance', 'as' => 'customers.balance']);
	Route::get('staffs/password/{id}',[ 'uses' => 'StaffsController@password', 'as' => 'staffs.password']);
	Route::post('staffs/password/{id}',[ 'uses' => 'StaffsController@password_store', 'as' => 'staffs.password_store']);
	Route::get('payments/accept/{id}',[ 'uses' => 'PaymentsController@accept', 'as' => 'payments.accept']);
	Route::get('payments/reject/{id}',[ 'uses' => 'PaymentsController@reject', 'as' => 'payments.reject']);
	Route::post('asks/edit/{userid}/{askid}',[ 'uses' => 'AsksController@edi2', 'as' => 'asks.edit2']);
	Route::post('bids/edit/{userid}/{bidi}',[ 'uses' => 'BidsController@edit2', 'as' => 'asks.edit2']);

	//index,show,store,edit,update,delete
    Route::resource('brands', 'BrandsController');
	Route::resource('payments', 'PaymentsController');
	Route::resource('debts', 'DebtsController');
	Route::resource('balance_ins', 'BalanceInsController');
	Route::resource('balance_outs', 'BalanceOutsController');
	Route::resource('bids', 'BidsController');
	Route::resource('invoices', 'InvoicesController');
	Route::resource('invoice_details', 'InvoicesDetailController');
	Route::resource('asks', 'AsksController');
	Route::resource('product_detail', 'ProductDetailsController');
    Route::resource('products', 'ProductsController');
    Route::resource('divisions', 'DivisionsController'); 
	Route::resource('staffs', 'StaffsController'); 
	Route::resource('customers', 'CustomersController');
	Route::resource('address', 'AddressController');
	Route::resource('roles', 'RolesController'); 
	Route::resource('permissions', 'PermissionsController');
	Route::resource('tickets', 'TicketsController');
	Route::resource('blogs', 'BlogsController');
	Route::resource('banners', 'BannersController');
	Route::resource('ticket-chats', 'TicketChatsController');
	
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

Route::group(['prefix' => 'location', 'namespace' => 'Location'], function () {
	Route::get('regencies/{id}',[ 'uses' => 'RegenciesController@getRegencies', 'as' => 'location.getregencies']);
	Route::get('address/{email}',[ 'uses' => 'AddressController@getAddress', 'as' => 'location.getaddress']);
	Route::get('districts/{id}',[ 'uses' => 'DistrictsController@getDistricts', 'as' => 'location.getdistrict']);
});	





