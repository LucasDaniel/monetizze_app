<?php

namespace App\Controllers;

use App\Http\Response;

class Controller {

    protected static function verifyDataAndReturn($arg) {
        if (isset($arg['error']) || !$arg) {
            return self::returnJsonError($arg);
        }
        return self::returnJsonSuccess($arg);
    }

    private static function returnJsonError($arg, int $code = 400) {
        return Response::json([
            'error' => false,
            'success' => true,
            'data' => $arg['error'] ? $arg['error'] : $arg,
        ],$code);
    }

    private static function returnJsonSuccess($arg, int $code = 200) {
        return Response::json([
            'error' => false,
            'success' => true,
            'data' => $arg,
        ],$code);
    }

}
