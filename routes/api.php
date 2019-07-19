<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'vendors'], static function () {
    Route::get('/', 'VendorsController@getList');
    Route::get('/{vendor}', 'VendorsController@get')->where(['vendor' => '[0-9]+']);
    Route::post('/{vendor}', 'VendorsController@update')->where(['vendor' => '[0-9]+']);

    Route::prefix('{vendor}/contacts')
        ->where(['vendor' => '[0-9]+'])
        ->group(static function () {
            Route::post('/create', 'VendorContactController@create');
        });
});
