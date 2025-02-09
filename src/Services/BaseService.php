<?php

namespace App\Services;

class BaseService {

    public static function error($e) {
        return ['error' => $e];
    }

}
