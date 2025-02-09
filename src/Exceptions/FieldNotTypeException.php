<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class FieldNotTypeException extends BaseException
{
    public static function exception(array $array)
    {
        $error = 'fieldNotType';
        self::baseExceptionValues($error,$array);
    }
}