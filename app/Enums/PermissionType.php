<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class PermissionType
 * @package App\Enums
 * @method static static SEE_VENDORS
 * @method static static EDIT_VENDORS
 * @method static static CREATE_VENDORS
 * @method static static DELETE_VENDORS
 * @method static static SEE_PARTNERS
 * @method static static EDIT_PARTNERS
 * @method static static CREATE_PARTNERS
 * @method static static DELETE_PARTNERS
 * @method static static SEE_COMPONENTS
 * @method static static EDIT_COMPONENTS
 * @method static static CREATE_COMPONENTS
 * @method static static DELETE_COMPONENTS
 * @method static static SEE_COMPONENT_CATEGORIES
 * @method static static EDIT_COMPONENT_CATEGORIES
 * @method static static CREATE_COMPONENT_CATEGORIES
 * @method static static DELETE_COMPONENT_CATEGORIES
 * @method static static SEE_ORDERS
 * @method static static EDIT_ORDERS
 * @method static static CREATE_ORDERS
 * @method static static DELETE_ORDERS
 * @method static static SEE_USERS
 * @method static static EDIT_USERS
 * @method static static CREATE_USERS
 * @method static static DELETE_USERS
 * @method static static SEE_STATUSES
 * @method static static EDIT_STATUSES
 * @method static static CREATE_STATUSES
 * @method static static DELETE_STATUSES
 * @method static static SEE_SETTINGS
 * @method static static EDIT_SETTINGS
 * @method static static EXPORT_DATA
 */
final class PermissionType extends Enum
{
    /** Vendors */
    public const SEE_VENDORS = 'see vendors';
    public const EDIT_VENDORS = 'edit vendors';
    public const CREATE_VENDORS = 'create vendors';
    public const DELETE_VENDORS = 'delete vendors';

    /** Partners */
    public const SEE_PARTNERS = 'see partners';
    public const EDIT_PARTNERS = 'edit partners';
    public const CREATE_PARTNERS = 'create partners';
    public const DELETE_PARTNERS = 'delete partners';

    /** Components */
    public const SEE_COMPONENTS = 'see components';
    public const EDIT_COMPONENTS = 'edit components';
    public const CREATE_COMPONENTS = 'create components';
    public const DELETE_COMPONENTS = 'delete components';

    /** Components */
    public const SEE_COMPONENT_CATEGORIES = 'see component categories';
    public const EDIT_COMPONENT_CATEGORIES = 'edit component categories';
    public const CREATE_COMPONENT_CATEGORIES = 'create component categories';
    public const DELETE_COMPONENT_CATEGORIES = 'delete component categories';

    /** Orders */
    public const SEE_ORDERS = 'see orders';
    public const EDIT_ORDERS = 'edit orders';
    public const CREATE_ORDERS = 'create orders';
    public const DELETE_ORDERS = 'delete orders';

    /** Users */
    public const SEE_USERS = 'see users';
    public const EDIT_USERS = 'edit users';
    public const CREATE_USERS = 'create users';
    public const DELETE_USERS = 'delete users';

    /** Users */
    public const SEE_STATUSES = 'see statuses';
    public const EDIT_STATUSES = 'edit statuses';
    public const CREATE_STATUSES = 'create statuses';
    public const DELETE_STATUSES = 'delete statuses';

    /** Settings */
    public const SEE_SETTINGS = 'see settings';
    public const EDIT_SETTINGS = 'edit settings';

    /** Reports */
    public const EXPORT_DATA = 'export data';

    /**
     * Returns permission name for middleware
     * @param string $permission
     * @return string
     */
    public static function getPermission(string $permission): string
    {
        return 'permission:' . $permission;
    }
}
