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


Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');
Route::get('people', 'PagesController@people');

Route::get('weekdays', 'WeekDaysController@list_week');

// Clients - Edição de Clientes
// Route::resource('clients', 'ClientsController');
Route::get('clients/', 'ClientsController@index');
Route::get('requests/{id}', 'ClientsController@requests');
// Route::get('clients/{id}/edit', 'LanguageController@getEdit');
Route::post('clients/{id}/', 'ClientsController@update');

// Orders

Route::get('orders/', 'OrdersController@index');
Route::get('orders/{id}/view_establishments/', 'EstablishmentsController@show');
Route::group(['middleware' => 'auth'], function() {
    Route::pattern('id', '[0-9]+');
    Route::get('orders/create', 'OrdersController@getCreate');
    Route::post('orders/create', 'OrdersController@postCreate');
    Route::get('orders/{id}/payments_index', 'OrdersController@payments_index');
});

// Item Orders

Route::group(['middleware' => 'auth'], function() {
    Route::pattern('id', '[0-9]+');
    Route::get('item_orders/', 'ItemOrdersController@index');
    // Route::get('item_orders/create', 'ItemOrdersController@getCreate');
    // Route::post('item_orders/create', 'ItemOrdersController@postCreate');
});

// Establishments

Route::get('establishments/', 'EstablishmentsController@index');
Route::get('establishments/{id}/view_establishment/', 'EstablishmentsController@view_establishment');

//Socialite

Route::get('loginFacebook', 'FacebookController@login');
Route::get('facebook', 'FacebookController@pageFacebook');
Route::get('authFacebookLogin/{user}', 'Auth\AuthController@authenticateUserFacebook');

Route::get('loginGitHub', 'GitHubController@login');
Route::get('github', 'GitHubController@pageGitHub');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function() {
    Route::pattern('id', '[0-9]+');
    Route::pattern('id2', '[0-9]+');    

    // Admin Dashboard

    Route::get('dashboard', 'DashboardController@index');
    Route::get('/', 'DashboardController@index');

    // Users

    Route::group(['middleware' => ['role:admin|establishment']], function() {
        Route::get('users/', ['uses' => 'UserController@index']);
        Route::get('users/create', 'UserController@getCreate');
        Route::post('users/create', 'UserController@postCreate');
        Route::get('users/{id}/edit', 'UserController@getEdit');
        Route::post('users/{id}/edit', 'UserController@postEdit');
        Route::get('users/{id}/delete', 'UserController@getDelete');
        Route::post('users/{id}/delete', 'UserController@postDelete');
        Route::get('users/data', 'UserController@data');
    });

    // Establishments

    Route::get('establishments/', ['uses' => 'EstablishmentsController@index', 'middleware' => 'role:admin|establishment']);
    Route::group(['middleware' => ['role:admin|establishment']], function() {
        Route::get('establishments/create', ['uses' => 'EstablishmentsController@create']);
        Route::post('establishments/create', ['uses' => 'EstablishmentsController@store']);
        Route::get('establishments/{id}/delete', ['uses' => 'EstablishmentsController@getDelete']);
        Route::post('establishments/{id}/delete', ['uses' => 'EstablishmentsController@postDelete']);
        Route::get('establishments/data', ['uses' => 'EstablishmentsController@data']);
    });
    Route::get('establishments/{id}/edit', ['uses' => 'EstablishmentsController@edit', 'middleware' => 'role:admin|establishment']);
    Route::post('establishments/{id}/edit', ['uses' => 'EstablishmentsController@update', 'middleware' => 'role:admin|establishment']);
    Route::get('establishments/{id}/show', 'EstablishmentsController@show');

    //Promotions
    Route::get('promotions/', 'PromotionsController@index');
    Route::get('promotions/create', 'PromotionsController@create');
    Route::post('promotions/create', 'PromotionsController@store');
    Route::get('promotions/{id}/edit', 'PromotionsController@edit');
    Route::post('promotions/{id}/edit', 'PromotionsController@update');
    Route::get('promotions/{id}/delete', 'PromotionsController@getDelete');
    Route::post('promotions/{id}/delete', 'PromotionsController@postDelete');
    Route::get('promotions/data', 'PromotionsController@data');

    //Products
    Route::get('products/', 'ProductsController@index');
    Route::get('products/create', 'ProductsController@create');
    Route::post('products/create', 'ProductsController@store');
    Route::get('products/data', 'ProductsController@data');
    Route::get('products/{id}/edit', 'ProductsController@edit');
    Route::post('products/{id}/edit', 'ProductsController@update');
    Route::get('products/{id}/delete', 'ProductsController@getDelete');
    Route::post('products/{id}/delete', 'ProductsController@postDelete');

    //ProductTypes
    Route::get('producttypes/', 'ProductTypesController@index');
    Route::get('producttypes/create', 'ProductTypesController@create');
    Route::post('producttypes/create', 'ProductTypesController@store');
    Route::get('producttypes/data', 'ProductTypesController@data');
    Route::get('producttypes/{id}/edit', 'ProductTypesController@edit');
    Route::post('producttypes/{id}/edit', 'ProductTypesController@update');
    Route::get('producttypes/{id}/delete', 'ProductTypesController@getDelete');
    Route::post('producttypes/{id}/delete', 'ProductTypesController@postDelete');


    Route::get('people/', 'PeopleController@index');
});
