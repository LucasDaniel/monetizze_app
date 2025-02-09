<?php

namespace App\Utils;

use App\Utils\Validator;
use App\Models\Tripulante;

class TripulanteValidator extends Validator {

    public static function validator(array $data) {

        $fields = [
            'nome' => [ $data['nome'] ?? '', 'string' ],
        ];

        self::validate($fields);
    }

    public static function verifyIdTripulante(array $data) {
        Tripulante::verifyIdTripulante($data);
    }

}