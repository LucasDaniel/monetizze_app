<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class SorteioHappenedException extends BaseException
{
    public static function exception()
    {
        $error = 'sorteioHappened';
        self::baseException($error);
    }
}