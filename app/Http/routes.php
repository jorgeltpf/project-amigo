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

Route::pattern('id', '[0-9]+');
Route::get('news/{id}', 'ArticlesController@show');
Route::get('video/{id}', 'VideoController@show');
Route::get('photo/{id}', 'PhotoController@show');

Route::get('weekdays', 'WeekDaysController@list_week'
    // function() {
    // if (Request::ajax()) {
    //     return "teste";
    // };
    // }
);

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

    Route::filter('admin', function()
    {
        if (!Entrust::hasRole('admin'))
        {
            return Redirect::to('/');
        }
    });

    Route::when('admin/language*', 'admin');
    Route::when('admin/newscategory*', 'admin');
    Route::when('admin/news*', 'admin');
    Route::when('admin/photoalbum*', 'admin');
    Route::when('admin/photo*', 'admin');
    Route::when('admin/videoalbum*', 'admin');
    Route::when('admin/video*', 'admin');
    Route::when('admin/establishments*', 'admin');

    # Admin Dashboard
    Route::get('dashboard', 'DashboardController@index');

    # Video
    Route::get('video', 'VideoController@index');
    Route::get('video/create', 'VideoController@getCreate');
    Route::post('video/create', 'VideoController@postCreate');
    Route::get('video/{id}/edit', 'VideoController@getEdit');
    Route::post('video/{id}/edit', 'VideoController@postEdit');
    Route::get('video/{id}/delete', 'VideoController@getDelete');
    Route::post('video/{id}/delete', 'VideoController@postDelete');
    Route::get('video/{id}/itemsforalbum', 'VideoController@itemsForAlbum');
    Route::get('video/{id}/{id2}/albumcover', 'VideoController@getAlbumCover');
    Route::get('video/data/{id}', 'VideoController@data');
    Route::get('video/reorder', 'VideoController@getReorder');

    # Users
    Route::get('users/', 'UserController@index');
    Route::get('users/create', 'UserController@getCreate');
    Route::post('users/create', 'UserController@postCreate');
    Route::get('users/{id}/edit', 'UserController@getEdit');
    Route::post('users/{id}/edit', 'UserController@postEdit');
    Route::get('users/{id}/delete', 'UserController@getDelete');
    Route::post('users/{id}/delete', 'UserController@postDelete');
    Route::get('users/data', 'UserController@data');

    // Route::resource('establishments', 'EstablishmentsController');
    Route::get('establishments/', 'EstablishmentsController@index');
    Route::get('establishments/create', 'EstablishmentsController@create');
    Route::post('establishments/create', 'EstablishmentsController@store');
    Route::get('establishments/{id}/edit', 'EstablishmentsController@edit');
    Route::post('establishments/{id}/edit', 'EstablishmentsController@update');
    Route::get('establishments/{id}/delete', 'EstablishmentsController@getDelete');
    Route::post('establishments/{id}/delete', 'EstablishmentsController@postDelete');
    // Route::delete('establishments/{id}/delete', 'EstablishmentsController@destroy');
    Route::get('establishments/data', 'EstablishmentsController@data');

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

    //ProductClasses
    Route::get('productclasses/', 'ProductClassesController@index');
    Route::get('productclasses/create', 'ProductClassesController@create');
    Route::post('productclasses/create', 'ProductClassesController@store');
    Route::get('productclasses/data', 'ProductClassesController@data');
    Route::get('productclasses/{id}/edit', 'ProductClassesController@edit');
    Route::post('productclasses/{id}/edit', 'ProductClassesController@update');
    Route::get('productclasses/{id}/delete', 'ProductClassesController@getDelete');
    Route::post('productclasses/{id}/delete', 'ProductClassesController@postDelete');

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
