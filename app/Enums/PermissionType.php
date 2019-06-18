<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class PermissionType
 * @package App\Enums
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
}
