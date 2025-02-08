<?php

namespace App\Utils;

use App\Utils\Validator;

class TripulanteBilheteValidator extends Validator {

    public static function validator(array $data) {

        $fields = self::validate([
            'id_tripulante' => $data['id_tripulante'] ?? '',
            'id_sorteio' => $data['id_sorteio'] ?? '',
            'numeros_escolhidos' => $data['numeros_escolhidos'] ?? '',
        ]);
        
        if (!is_countable($fields)) return false;

        return $fields;
    }

}