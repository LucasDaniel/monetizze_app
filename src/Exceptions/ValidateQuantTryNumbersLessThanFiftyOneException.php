<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class ValidateQuantTryNumbersLessThanFiftyOneException extends BaseException
{
    public static function exception()
    {
        $error = 'validateQuantTryNumbersLessThanFiftyOne';
        self::baseException($error);
    }
}