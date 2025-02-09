<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class ValidateQuantNumbersException extends BaseException
{
    public static function exception()
    {
        $error = 'validateQuantNumbers';
        self::baseException($error);
    }
}