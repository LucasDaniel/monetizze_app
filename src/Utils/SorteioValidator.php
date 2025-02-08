<?php

namespace App\Utils;

use App\Utils\Validator;

class SorteioValidator extends Validator {

    public static function validator(array $data) {

        $fields = [
            'numeros_sorteados' => $data['numeros_sorteados'] ?? '',
        ];

        self::validate($fields);

        return $fields;
    }

}