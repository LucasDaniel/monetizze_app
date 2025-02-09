<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class ValidatorSameNumbersException extends BaseException
{
    public static function exception()
    {
        $error = 'validatorSameNumbers';
        self::baseException($error);
    }
}