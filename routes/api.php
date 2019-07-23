<?php

use App\Enums\PermissionType;

Route::prefix('v1')->group(static function () {
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
            Route::put('/{vendor}', 'VendorsController@update')
                ->name('vendors.update')
                ->middleware(permissionMiddleware(PermissionType::EDIT_VENDORS()));
            Route::delete('/{vendor}', 'VendorsController@delete')
                ->name('vendors.delete')
                ->middleware(permissionMiddleware(PermissionType::DELETE_VENDORS()));

            Route::prefix('{vendor}/contacts')
                ->group(static function () {
                    Route::post('/create', 'VendorContactsController@create')
                        ->name('vendors.contacts.create')
                        ->middleware(permissionMiddleware(PermissionType::CREATE_VENDORS()));
                    Route::delete('/{contact}', 'VendorContactsController@delete')
                        ->name('vendor.contacts.delete')
                        ->middleware(permissionMiddleware(PermissionType::DELETE_VENDORS()));
                });
        });

    Route::prefix('components')
        ->where(['component' => '[0-9]+', 'componentCategory' => '[0-9]+'])
        ->group(static function () {
            Route::get('/', 'ComponentsController@getList')
                ->name('components.list')
                ->middleware(permissionMiddleware(PermissionType::SEE_COMPONENTS()));
            Route::post('/', 'ComponentsController@create')
                ->name('components.create')
                ->middleware(permissionMiddleware(PermissionType::CREATE_COMPONENTS()));
            Route::put('/{component}', 'ComponentsController@update')
                ->name('components.update')
                ->middleware(permissionMiddleware(PermissionType::EDIT_COMPONENTS()));
            Route::delete('/{component}', 'ComponentsController@delete')
                ->name('components.delete')
                ->middleware(permissionMiddleware(PermissionType::DELETE_COMPONENTS()));

            Route::prefix('categories')
                ->group(static function () {
                    Route::get('/', 'ComponentCategoriesController@getList')
                        ->name('components.categories.list')
                        ->middleware(permissionMiddleware(PermissionType::SEE_COMPONENT_CATEGORIES()));
                    Route::post('/', 'ComponentCategoriesController@create')
                        ->name('components.categories.create')
                        ->middleware(permissionMiddleware(PermissionType::CREATE_COMPONENT_CATEGORIES()));
                    Route::put('/{componentCategory}', 'ComponentCategoriesController@update')
                        ->name('components.categories.update')
                        ->middleware(permissionMiddleware(PermissionType::EDIT_COMPONENT_CATEGORIES()));
                });
        });
});

