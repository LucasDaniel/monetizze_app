<?php

namespace App\Utils;

use App\Utils\Validator;
use App\Utils\SorteioValidator;
use App\Utils\TripulanteValidator;
use App\Models\TripulanteBilhete;
use App\Exceptions\ValidateQuantNumbersException;
use App\Exceptions\ValidateQuantTryNumbersGreaterThanZero;
use App\Exceptions\ValidateQuantTryNumbersLessThanFiftyOne;
use App\Exceptions\ValidatorSameNumbers;

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
            ValidateQuantNumbersException::exception();
        }
    }

    private static function validateQuantTryNumbers(array $data) {
        if ($data['quantTryNumbers'] < 1) {
            ValidateQuantTryNumbersGreaterThanZero::exception();
        }
        if ($data['quantTryNumbers'] > 50) {
            ValidateQuantTryNumbersLessThanFiftyOne::exception();
        }
    }

    private static function validateQuantTryMaxNumbers(array $data) {
        $numbersTry = TripulanteBilhete::validateQuantTryMaxNumbers($data);
        if (($numbersTry + $data['quantTryNumbers'][0]) > 50) {
            ValidateQuantTryNumbersLessThanFiftyOne::exception();
        }
    }

    public static function returnValidatorSameNumbers(array $data) {
        return TripulanteBilhete::verifySameNumbersToSorteio($data);
    }

    private static function validatorSameNumbers(array $data) {
        $numbersSorteio = self::returnValidatorSameNumbers($data);
        if ($numbersSorteio) {
            ValidatorSameNumbers::exception();
        }
    }

}