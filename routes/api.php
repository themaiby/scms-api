<?php

use App\Enums\PermissionType;

Route::prefix('v1')->group(static function () {

    /**
     * Authentication
     */
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

    /**
     * Vendors
     */
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

            /**
             * Vendor contacts
             */
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

    /**
     * Components
     */
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

            /**
             * Component categories
             */
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

    /**
     * Partners
     */
    Route::prefix('partners')
        ->where(['partner' => '[0-9]+'])
        ->group(static function () {
            Route::get('/', 'PartnersController@getList')
                ->name('partners.list')
                ->middleware(permissionMiddleware(PermissionType::SEE_PARTNERS()));
            Route::post('/', 'PartnersController@create')
                ->name('partners.create')
                ->middleware(permissionMiddleware(PermissionType::CREATE_PARTNERS()));
            Route::get('/{partner}', 'PartnersController@get')
                ->name('partners.get')
                ->middleware(permissionMiddleware(PermissionType::SEE_PARTNERS()));
            Route::put('/{partner}', 'PartnersController@update')
                ->name('partners.update')
                ->middleware(permissionMiddleware(PermissionType::EDIT_PARTNERS()));
            Route::delete('/{partner}', 'PartnersController@delete')
                ->name('partners.delete')
                ->middleware(permissionMiddleware(PermissionType::DELETE_PARTNERS()));

            /**
             * Partner contacts
             */
            Route::prefix('{partner}/contacts')
                ->group(static function () {
                    Route::post('/create', 'PartnerContactsController@create')
                        ->name('partners.contacts.create')
                        ->middleware(permissionMiddleware(PermissionType::CREATE_PARTNERS()));
                    Route::delete('/{contact}', 'PartnerContactsController@delete')
                        ->name('partners.contacts.delete')
                        ->middleware(permissionMiddleware(PermissionType::DELETE_PARTNERS()));
                });
        });

    /**
     * Orders
     */
    Route::prefix('orders')
        ->where(['order' => '[0-9]+', 'orderStatus' => '[0-9]+', 'type' => '[0-9]+'])
        ->group(static function () {
            Route::get('/', 'OrdersController@getList')
                ->name('orders.list')
                ->middleware(permissionMiddleware(PermissionType::SEE_ORDERS()));
            Route::get('/{order}', 'OrdersController@get')
                ->name('orders.get')
                ->middleware(permissionMiddleware(PermissionType::SEE_ORDERS()));
            Route::post('/', 'OrdersController@create')
                ->name('orders.create')
                ->middleware(permissionMiddleware(PermissionType::CREATE_ORDERS()));
            Route::put('/{order}', 'OrdersController@update')
                ->name('orders.update')
                ->middleware(permissionMiddleware(PermissionType::EDIT_ORDERS()));
            Route::delete('/{order}', 'OrdersController@delete')
                ->name('orders.delete')
                ->middleware(permissionMiddleware(PermissionType::DELETE_ORDERS()));

            /**
             * Order statuses
             */
            Route::prefix('statuses')
                ->group(static function () {
                    Route::post('/', 'OrderStatusesController@create')
                        ->name('orders.statuses.create')
                        ->middleware(permissionMiddleware(PermissionType::CREATE_ORDERS()));
                    Route::get('/', 'OrderStatusesController@getList')
                        ->name('order.statuses.list')
                        ->middleware(permissionMiddleware(PermissionType::SEE_ORDERS()));
                });

            /**
             * Order types
             */
            Route::prefix('types')
                ->group(static function () {
                    Route::get('/', 'OrderTypesController@getList')
                        ->name('orders.types.list')
                        ->middleware(permissionMiddleware(PermissionType::SEE_ORDERS()));
                    Route::post('/', 'OrderTypesController@create')
                        ->name('orders.types.create')
                        ->middleware(permissionMiddleware(PermissionType::CREATE_ORDERS()));
                    Route::put('/{type}', 'OrderTypesController@update')
                        ->name('orders.types.update')
                        ->middleware(permissionMiddleware(PermissionType::EDIT_ORDERS()));
                });
        });
});

