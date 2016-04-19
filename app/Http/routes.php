<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'FrontendController@welcome');
Route::get('admin', function(){
    return redirect('/orders');
});

Route::group(['prefix' => 'Api'], function(){
    Route::post('login', 'Api\AuthenticateController@authenticate');
    Route::get('check-in/{unique_code}', 'Api\TicketController@checkIn');
    Route::get('orders-cancel', 'Api\OrderController@cancel');
});

//USER web


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//testing

Route::group(['middleware' => ['web']], function () {
    // Route::get('/login', 'Auth\AuthController@showLoginForm');
    // Route::post('/login', 'Auth\AuthController@login');
    // Route::get('/logout', 'Auth\AuthController@logout');
    Route::auth();
    //require auth
    Route::post('orders/resend-mail-online-order','OrderController@resendMailOnlineOrder');
    Route::get('orders/cancel', 'OrderController@cancel');
    Route::post('orders/store-offline','OrderController@storeOffline');
    Route::get('orders/create-offline','OrderController@createOffline');
    Route::resource('orders', 'OrderController');

    /*TEST*/
    Route::get('tickets/create-check-in',function(){
      return view('tickets.create-check-in');
    });
    /*TEST*/
    Route::resource('tickets', 'TicketController');
    Route::get('tickets/print/{unique_code}', 'TicketController@printTicket');

    Route::get('types/print/{id}', 'TypeController@printTicket');
    Route::post('types/remove-eager','TypeController@removeAllAssociatedWithType');
    Route::post('types/remove-lazy','TypeController@removeAllRelationsAssociatedWithType');
    Route::post('types/{id}/convert-tickets','TypeController@changeAllNotOrderedTicketType');
    Route::resource('types', 'TypeController');

    Route::resource('confirmations', 'ConfirmationController');
    Route::post('confirmations/validate','ConfirmationController@validateOrder');
    Route::post('confirmations/resendMail','ConfirmationController@resendMail');

    Route::get('buy', 'FrontendController@buy');
    Route::post('buy', 'FrontendController@buyStore');
    Route::get('confirmation', 'FrontendController@confirmation');
    Route::post('confirmation', 'FrontendController@confirmationStore');

    Route::resource('statistics','StatisticController');

    //API Android
    Route::get('tickets/get-data/{code}','Api\TicketController@getTicketData');
    Route::post('tickets/check-in','Api\TicketController@checkIn');

});
