<?php

namespace App\Validators;

use App\Validators\Validator;
use App\Models\Tripulante;
use App\Enums\TypesEnum;

class TripulanteValidator extends Validator {

    public static function validator(array $data) {

        $fields = [
            'nome' => [ $data['nome'] ?? '', TypesEnum::STRING() ],
        ];

        self::validate($fields);
    }

    public static function verifyIdTripulante(array $data) {
        Tripulante::verifyIdTripulante($data);
    }

}