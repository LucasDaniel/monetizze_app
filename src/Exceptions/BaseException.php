<?php

namespace App\Exceptions;

use App\Dictionary\Dictionary;
use Exception;
 
class BaseException extends Exception
{

    protected static function baseException($error)
    {
        throw new Exception(Dictionary::dictionary()['error'][$error]);
    }
}