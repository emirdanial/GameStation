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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('/admin/roles','RoleController')->middleware('role:Superadmin');
    Route::resource('/admin/users','UserController')->middleware('role:Superadmin');
    Route::resource('/admin/products','ProductController')->middleware('role:Staff|Superadmin');
    Route::resource('/admin/permissions', 'PermissionController')->middleware('role:Superadmin');
    Route::resource('/admin/orders','OrderController')->middleware('role:Superadmin');

    Route::get('/products/{product}/show', 'ProductController@show');
    Route::get('/profile', 'ProfileController@index')->name('profile.index')->middleware('permission:manage profile');
    Route::get('/profile/order', 'ProfileController@viewOrder');
});


Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

// Route::get('cart', 'CartController@index')->name('cart.index');
// Route::post('cart/{id}', 'CartController@store')->name('cart.store');
Route::resource('cart','CartController');

Route::resource('shop', 'ShopController');

