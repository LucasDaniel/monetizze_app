<?php

namespace App\Utils;

use App\Utils\Validator;
use App\Models\TripulanteBilhete;

class TripulanteBilheteValidator extends Validator {

    public static function validator(array $data) {

        $fields = [
            'id_tripulante' => $data['id_tripulante'] ?? '',
            'id_sorteio' => $data['id_sorteio'] ?? '',
            'numeros_escolhidos' => $data['numeros_escolhidos'] ?? '',
        ];

        self::validate($fields);
        self::validatorSameNumbers($fields);
        
        return $fields;
    }

    private static function validatorSameNumbers(array $data) {
        $numbersSorteio = TripulanteBilhete::verifySameNumbersToSorteio($data);
        if ($numbersSorteio) {
            throw new \Exception("Esses numeros já foram apostados para esse usuario nessa aposta");
        }
    }

}