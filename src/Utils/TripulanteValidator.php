<?php

namespace App\Utils;

use App\Utils\Validator;

class TripulanteValidator extends Validator {

    public static function validator(array $data) {

        $fields = [
            'name' => $data['name'] ?? '',
        ];

        self::validate($fields);

        return $fields;
    }

}