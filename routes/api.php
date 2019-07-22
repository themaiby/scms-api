<?php

Route::prefix('auth')
    ->middleware('api')
    ->group(static function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });

Route::prefix('vendors')
    ->where(['vendor' => '[0-9]+'])
    ->group(static function () {
        Route::get('/', 'VendorsController@getList');
        Route::post('/', 'VendorsController@create');
        Route::get('/{vendor}', 'VendorsController@get');
        Route::post('/{vendor}', 'VendorsController@update');
        Route::delete('/{vendor}', 'VendorsController@delete');
        Route::prefix('{vendor}/contacts')
            ->group(static function () {
                Route::post('/create', 'VendorContactController@create');
            });
    });
