<?php

use App\Enums\PermissionType;

Route::prefix('auth')
    ->middleware('api')
    ->group(static function () {
        Route::post('login', 'AuthController@login')
            ->name('auth.login');
        Route::post('logout', 'AuthController@logout')
            ->name('auth.logout');
        Route::post('refresh', 'AuthController@refresh')
            ->name('auth.refresh');
        Route::post('me', 'AuthController@me')
            ->name('auth.me');
    });

Route::prefix('vendors')
    ->where(['vendor' => '[0-9]+'])
    ->group(static function () {
        Route::get('/', 'VendorsController@getList')
            ->name('vendors.list')
            ->middleware(permissionMiddleware(PermissionType::SEE_VENDORS()));
        Route::post('/', 'VendorsController@create')
            ->name('vendors.create')
            ->middleware(permissionMiddleware(PermissionType::CREATE_VENDORS()));
        Route::get('/{vendor}', 'VendorsController@get')
            ->name('vendors.get')
            ->middleware(permissionMiddleware(PermissionType::SEE_VENDORS()));
        Route::post('/{vendor}', 'VendorsController@update')
            ->name('vendors.update')
            ->middleware(permissionMiddleware(PermissionType::EDIT_VENDORS()));
        Route::delete('/{vendor}', 'VendorsController@delete')
            ->name('vendors.delete')
            ->middleware(permissionMiddleware(PermissionType::DELETE_VENDORS()));

        Route::prefix('{vendor}/contacts')
            ->group(static function () {
                Route::post('/create', 'VendorContactController@create')
                    ->name('vendors.contacts.create')
                    ->middleware(permissionMiddleware(PermissionType::CREATE_VENDORS()));
                Route::delete('/{contact}', 'VendorContactController@delete')
                    ->name('vendor.contacts.delete')
                    ->middleware(permissionMiddleware(PermissionType::DELETE_VENDORS()));
            });
    });
