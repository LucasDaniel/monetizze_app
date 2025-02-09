<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class ValidateQuantTryNumbersLessThanFiftyOne extends BaseException
{
    public static function exception()
    {
        $error = 'validateQuantTryNumbersLessThanFiftyOne';
        self::baseException($error);
    }
}