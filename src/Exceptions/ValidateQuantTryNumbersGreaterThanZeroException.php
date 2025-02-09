<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class ValidateQuantTryNumbersGreaterThanZeroException extends BaseException
{
    public static function exception()
    {
        $error = 'validateQuantTryNumbersGreaterThanZero';
        self::baseException($error);
    }
}