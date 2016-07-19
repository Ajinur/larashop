<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::auth();


Route::post('authenticate', ['as'=>'login', 'uses'=>'Sentinel\AuthController@authenticate']);
Route::get('logout', ['uses'=>'Sentinel\AuthController@logout'])->middleware(['webAuth']);
//Route::get('test', 'FrontendController@test');
Route::get('login', function(){
	return view('auth/login');
});

Route::post('/send', 'FrontendController@send');
Route::get('/', 'FrontendController@index');
Route::get('/product/{slug}', ['as' => 'product.detail', 'uses' => 'FrontendController@detailProduct']);
Route::get('/category/{slug}', ['as' => 'category.detail', 'uses' => 'FrontendController@detailCategory']);
Route::get('/brand/{slug}', ['as' => 'brand.detail', 'uses' => 'FrontendController@detailBrand']);
Route::get('/information/{slug}', ['as' => 'information', 'uses' => 'FrontendController@detailInformation']);
Route::get('/cart', ['as' => 'cart', 'uses' => 'FrontendController@cart']);
Route::post('/cart', ['as' => 'cart', 'uses' => 'FrontendController@addtoCart']);
Route::get('/cart/delete/{id}', ['as' => 'cart.delete', 'uses' => 'FrontendController@deleteCart']);
Route::get('/cart/checkout', ['as' => 'checkout', 'uses' => 'FrontendController@checkout']);
Route::post('/cart/{form_id}/save', ['as' => 'customer.save', 'uses' => 'FrontendController@saveCustomer']);
Route::post('invoice', ['as' => 'customer.store', 'uses' => 'FrontendController@storeCustomer']);
Route::post('review', ['as' => 'review', 'uses' => 'FrontendController@storeReview']);

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', function(){
    	return view('admin.login');
    });
    
    Route::get('/home', 'HomeController@index');
    
    Route::get('categories', ['as' => 'categories', 'uses' => 'BackendController@getCategories']);
    Route::get('categories/data', ['as' => 'categories.data', 'uses' => 'BackendController@getCategoriesData']);
    Route::get('categories/create', ['as' => 'categories.create', 'uses' => 'BackendController@createCategories']);
    Route::get('categories/edit/{id}', ['as' => 'categories.edit', 'uses' => 'BackendController@editCategories']);
    Route::get('categories/delete/{id}', ['as' => 'categories.delete', 'uses' => 'BackendController@deleteCategories']);
    Route::post('categories/store', ['as' => 'categories.store', 'uses' => 'BackendController@storeCategories']);
    Route::post('categories/update/{id}', ['as' => 'categories.update', 'uses' => 'BackendController@updateCategories']);

    Route::get('products', ['as' => 'products', 'uses' => 'BackendController@getProducts']);
    Route::get('products/data', ['as' => 'products.data', 'uses' => 'BackendController@getProductsData']);
    Route::get('products/create', ['as' => 'products.create', 'uses' => 'BackendController@createProducts']);
    Route::get('products/edit/{id}', ['as' => 'products.edit', 'uses' => 'BackendController@editProducts']);
    Route::get('products/delete/{id}', ['as' => 'products.delete', 'uses' => 'BackendController@deleteProducts']);
    Route::post('products/store', ['as' => 'products.store', 'uses' => 'BackendController@storeProducts']);
    Route::post('products/update/{id}', ['as' => 'products.update', 'uses' => 'BackendController@updateProducts']);

    Route::get('tags', ['as' => 'tags', 'uses' => 'BackendController@getTags']);
    Route::get('tags/data', ['as' => 'tags.data', 'uses' => 'BackendController@getTagsData']);
    Route::get('tags/create', ['as' => 'tags.create', 'uses' => 'BackendController@createTags']);
    Route::get('tags/edit/{id}', ['as' => 'tags.edit', 'uses' => 'BackendController@editTags']);
    Route::get('tags/delete/{id}', ['as' => 'tags.delete', 'uses' => 'BackendController@deleteTags']);
    Route::post('tags/store', ['as' => 'tags.store', 'uses' => 'BackendController@storeTags']);
    Route::post('tags/update/{id}', ['as' => 'tags.update', 'uses' => 'BackendController@updateTags']);

    Route::get('information', ['as' => 'information', 'uses' => 'BackendController@getInformation']);
    Route::get('information/data', ['as' => 'information.data', 'uses' => 'BackendController@getInformationData']);
    Route::get('information/create', ['as' => 'information.create', 'uses' => 'BackendController@createInformation']);
    Route::get('information/edit/{id}', ['as' => 'information.edit', 'uses' => 'BackendController@editInformation']);
    Route::get('information/delete/{id}', ['as' => 'information.delete', 'uses' => 'BackendController@deleteInformation']);
    Route::post('information/store', ['as' => 'information.store', 'uses' => 'BackendController@storeInformation']);
    Route::post('information/update/{id}', ['as' => 'information.update', 'uses' => 'BackendController@updateInformation']);

    Route::get('review', ['as' => 'review', 'uses' => 'BackendController@getReview']);
    Route::get('review/data', ['as' => 'review.data', 'uses' => 'BackendController@getReviewData']);
	Route::get('review/approved/{id}', ['as' => 'review.approved', 'uses' => 'BackendController@makeApproved']);

    Route::get('orders', ['as' => 'orders', 'uses' => 'OrderController@index']);
    Route::get('orders/data', ['as' => 'orders.data', 'uses' => 'OrderController@data']);
    Route::get('review/process/{id}', ['as' => 'orders.process', 'uses' => 'OrderController@makeProcess']);
    Route::get('orders/edit/{id}', ['as' => 'orders.edit', 'uses' => 'OrderController@edit']);
    Route::get('orders/view/{id}', ['as' => 'orders.view', 'uses' => 'OrderController@view']);
    Route::get('orders/delete/{id}', ['as' => 'orders.delete', 'uses' => 'OrderController@destroy']);
    Route::post('orders/update/{id}', ['as' => 'orders.update', 'uses' => 'OrderController@update']);

    Route::get('customers', ['as' => 'customers', 'uses' => 'BackendController@getCustomers']);
    Route::get('customers/data', ['as' => 'customers.data', 'uses' => 'BackendController@getCustomersData']);
    Route::get('customers/create', ['as' => 'customers.create', 'uses' => 'BackendController@createCustomers']);
    Route::get('customers/edit/{id}', ['as' => 'customers.edit', 'uses' => 'BackendController@editCustomers']);
    Route::get('customers/delete/{id}', ['as' => 'customers.delete', 'uses' => 'BackendController@deleteCustomers']);
    Route::post('customers/store', ['as' => 'customers.store', 'uses' => 'BackendController@storeCustomers']);
    Route::post('customers/update/{id}', ['as' => 'customers.update', 'uses' => 'BackendController@updateCustomers']);

    Route::get('customergroups', ['as' => 'customergroups', 'uses' => 'BackendController@getCustomerGroups']);
    Route::get('customergroups/data', ['as' => 'customergroups.data', 'uses' => 'BackendController@getCustomerGroupsData']);
    Route::get('customergroups/create', ['as' => 'customergroups.create', 'uses' => 'BackendController@createCustomerGroups']);
    Route::get('customergroups/edit/{id}', ['as' => 'customergroups.edit', 'uses' => 'BackendController@editCustomerGroups']);
    Route::get('customergroups/delete/{id}', ['as' => 'customergroups.delete', 'uses' => 'BackendController@deleteCustomerGroups']);
    Route::post('customergroups/store', ['as' => 'customergroups.store', 'uses' => 'BackendController@storeCustomerGroups']);
    Route::post('customergroups/update/{id}', ['as' => 'customergroups.update', 'uses' => 'BackendController@updateCustomerGroups']);

    Route::get('system/settings', ['as' => 'system.settings', 'uses' => 'SystemController@getSettings']);
    Route::post('system/settings/update/{id}', ['as' => 'system.settings.update', 'uses' => 'SystemController@updateSettings']);

    /*Route::get('system/users', ['as' => 'system.users', 'uses' => 'Sentinel\UserController@index']);
    Route::get('system/users/data', ['as' => 'system.users.data', 'uses' => 'Sentinel\UserController@index']);
    Route::get('system/users/create', ['as' => 'system.users.create', 'uses' => 'Sentinel\UserController@create']);
    Route::get('system/users/edit/{id}', ['as' => 'system.users.edit', 'uses' => 'Sentinel\UserController@edit']);
    Route::post('system/users/store', ['as' => 'system.users.store', 'uses' => 'Sentinel\UserController@store']);
    Route::post('system/users/update/{id}', ['as' => 'system.users.update', 'uses' => 'Sentinel\UserController@update']);*/

    Route::get('tools/backup', ['as' => 'backup', 'uses' => 'BackupController@index']);
    Route::get('tools/backup/create', ['as' => 'backup.create', 'uses' => 'BackupController@backup']);
    Route::get('tools/backup/list', ['as' => 'backup.list', 'uses' => 'BackupController@listBackup']);

    Route::get('report/sales', ['as' => 'report.sales', 'uses' => 'ReportController@sales']);
    Route::get('report/product', ['as' => 'report.product', 'uses' => 'ReportController@product']);
});

