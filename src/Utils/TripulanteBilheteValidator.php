<?php

namespace App\Utils;

use App\Utils\Validator;
use App\Utils\SorteioValidator;
use App\Utils\TripulanteValidator;
use App\Models\TripulanteBilhete;

class TripulanteBilheteValidator extends Validator {

    public static function validateTryRandomNumbers(array $data) {

        $fields = [
            'id_tripulante' => [ $data['id_tripulante'] ?? '', 'integer' ],
            'id_sorteio' => [ $data['id_sorteio'] ?? '', 'integer' ],
            'quantTryNumbers' => [ $data['quantTryNumbers'] ?? '', 'integer' ],
            'quantNumbers' => [ $data['quantNumbers'] ?? '', 'integer' ],
        ];
        
        self::validate($fields);
        SorteioValidator::verifySorteioNotHappened($fields);
        self::validateQuantNumbers($data);
        self::validateQuantTryNumbers($data);
        self::validateQuantTryMaxNumbers($fields);
    }

    private static function validateQuantNumbers(array $data) {
        if ($data['quantNumbers'] < 6 || $data['quantNumbers'] > 10) {
            throw new \Exception("A quantidade de numeros a sortear não esta entre 6 e 10 (inclusive)");
        }
    }

    private static function validateQuantTryNumbers(array $data) {
        if ($data['quantTryNumbers'] < 1) {
            throw new \Exception("A quantidade de apostas precisa ser maior que 0");
        }
        if ($data['quantTryNumbers'] > 50) {
            throw new \Exception("A quantidade de apostas por usuário não pode ultrapassar 50 apostas");
        }
    }

    private static function validateQuantTryMaxNumbers(array $data) {
        $numbersTry = TripulanteBilhete::validateQuantTryMaxNumbers($data);
        if (($numbersTry + $data['quantTryNumbers'][0]) > 50) {
            throw new \Exception("A quantidade de apostas por usuario não pode ultrapassar 50 apostas");
        }
    }

    public static function returnValidatorSameNumbers(array $data) {
        return TripulanteBilhete::verifySameNumbersToSorteio($data);
    }

    private static function validatorSameNumbers(array $data) {
        $numbersSorteio = self::returnValidatorSameNumbers($data);
        if ($numbersSorteio) {
            throw new \Exception("Esses numeros já foram apostados para esse usuario nessa aposta");
        }
    }

}