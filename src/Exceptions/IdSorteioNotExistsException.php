<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class IdSorteioNotExistsException extends BaseException
{
    public static function exception()
    {
        $error = 'idSorteioNotExists';
        self::baseException($error);
    }
}