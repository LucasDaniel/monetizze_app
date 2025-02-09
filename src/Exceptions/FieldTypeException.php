<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class FieldTypeException extends BaseException
{
    public static function exception(array $array)
    {
        $error = 'fieldType';
        self::baseExceptionValues($error,$array);
    }
}