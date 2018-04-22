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

Route::post('/Language', array(
   'Middleware'=>'LanguageSwitch',
   'uses'=>'LanguageController@index'
    ));

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'admin'], function() {

    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/admin/about', 'AdminController@about')->name('admin.about');
    Route::get('admin/search/autocomplete', 'AdminController@search');

    Route::resource('admin/users', 'AdminUsersController', ['names'=>[
        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'store'=>'admin.users.store',
        'edit'=>'admin.users.edit'
    ]]);

    Route::resource('admin/cars', 'AdminCarsController', ['names'=>[
        'index'=>'admin.cars.index',
        'create'=>'admin.cars.create',
        'store'=>'admin.cars.store',
        'edit'=>'admin.cars.edit',
        'show'=>'admin.cars.show'
    ]]);

    Route::get('admin/cars/model/{id}', 'AdminCarsController@modelList')->name('admin.cars.modelList');
    Route::get('/admin/cars/auto/complete', 'AdminCarsController@autocomplete')->name('admin.cars.auto');

    Route::resource('admin/drivers', 'AdminDriverController', ['names'=>[
        'index'=>'admin.drivers.index',
        'create'=>'admin.drivers.create',
        'store'=>'admin.drivers.store',
        'edit'=>'admin.drivers.edit',
        'show'=>'admin.drivers.show'
    ]]);

    Route::resource('admin/transport', 'AdminTransportController', ['names'=>[
        'index'=>'admin.transport.index',
        'create'=>'admin.transport.create',
        'store'=>'admin.transport.store',
        'edit'=>'admin.transport.edit',
        'show'=>'admin.transport.show'
    ]]);

    Route::get('/admin/transport/find/car', 'AdminTransportController@findCar');

    Route::get('/admin/transport/find/driver', 'AdminTransportController@findDriver');

    Route::resource('admin/media', 'AdminMediasController', ['names'=>[
        'index'=>'admin.media.index',
        'create'=>'admin.media.create',
        'store'=>'admin.media.store',
        'edit'=>'admin.media.edit'
    ]]);

    Route::get('admin/createCar/{id}', 'AdminMediasController@createCar');

    Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');

    Route::resource('admin/brand', 'AdminModelBrandController', ['names'=>[
        'index'=>'admin.brand.index',
        'store'=>'admin.brand.store',
        'show'=>'admin.brand.show',
        'edit'=>'admin.brand.edit',
        'update'=>'admin.brand.update'
    ]]);

    Route::resource('admin/customer', 'AdminCustomerController', ['names'=>[
        'index'=>'admin.customer.index',
        'store'=>'admin.customer.store',
        'show'=>'admin.customer.show',
        'edit'=>'admin.customer.edit',
        'update'=>'admin.customer.update'
    ]]);
});
