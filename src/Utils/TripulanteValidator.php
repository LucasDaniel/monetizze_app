<?php

namespace App\Utils;

use App\Utils\Validator;

class TripulanteValidator extends Validator {

    public static function validator(array $data) {

        $fields = self::validate([
            'name' => $data['name'] ?? '',
        ]);
        
        if (!is_countable($fields)) return false;

        return $fields;
    }

}