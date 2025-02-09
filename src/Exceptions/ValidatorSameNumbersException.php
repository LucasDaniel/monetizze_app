<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class ValidatorSameNumbers extends BaseException
{
    public static function exception()
    {
        $error = 'validatorSameNumbers';
        self::baseException($error);
    }
}