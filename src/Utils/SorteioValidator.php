<?php

namespace App\Utils;

use App\Utils\Validator;

class SorteioValidator extends Validator {

    public static function validator(array $data) {

        $fields = self::validate([
            'numeros_sorteados' => $data['numeros_sorteados'] ?? '',
        ]);
        
        if (!is_countable($fields)) return false;

        return $fields;
    }

}