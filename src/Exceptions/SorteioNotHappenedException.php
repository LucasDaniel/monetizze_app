<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class SorteioNotHappenedException extends BaseException
{
    public static function exception()
    {
        $error = 'sorteioNotHappened';
        self::baseException($error);
    }
}