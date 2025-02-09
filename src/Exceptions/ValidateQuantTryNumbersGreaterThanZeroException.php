<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class ValidateQuantTryNumbersGreaterThanZero extends BaseException
{
    public static function exception()
    {
        $error = 'validateQuantTryNumbersGreaterThanZero';
        self::baseException($error);
    }
}