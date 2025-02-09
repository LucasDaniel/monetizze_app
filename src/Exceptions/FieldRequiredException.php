<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class FieldRequiredException extends BaseException
{
    public static function exception(array $array)
    {
        $error = 'fieldRequired';
        self::baseExceptionValues($error,$array);
    }
}