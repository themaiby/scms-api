<?php

namespace App\Exceptions;

use Exception;

class ComponentQuantityException extends Exception
{
    protected $message = 'New quantity can\'t be more than summary stored component\'s quantity';
}
