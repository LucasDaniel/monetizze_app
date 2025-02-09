<?php

namespace App\Validators;

use App\Validators\Validator;
use App\Validators\SorteioValidator;
use App\Validators\TripulanteValidator;
use App\Models\TripulanteBilhete;
use App\Exceptions\ValidateQuantNumbersException;
use App\Exceptions\ValidateQuantTryNumbersGreaterThanZeroException;
use App\Exceptions\ValidateQuantTryNumbersLessThanFiftyOneException;
use App\Exceptions\ValidatorSameNumbersException;

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
            ValidateQuantTryNumbersGreaterThanZeroException::exception();
        }
        if ($data['quantTryNumbers'] > 50) {
            ValidateQuantTryNumbersLessThanFiftyOneException::exception();
        }
    }

    private static function validateQuantTryMaxNumbers(array $data) {
        $numbersTry = TripulanteBilhete::validateQuantTryMaxNumbers($data);
        if (($numbersTry + $data['quantTryNumbers'][0]) > 50) {
            ValidateQuantTryNumbersLessThanFiftyOneException::exception();
        }
    }

    public static function returnValidatorSameNumbers(array $data) {
        return TripulanteBilhete::verifySameNumbersToSorteio($data);
    }

    private static function validatorSameNumbers(array $data) {
        $numbersSorteio = self::returnValidatorSameNumbers($data);
        if ($numbersSorteio) {
            ValidatorSameNumbersException::exception();
        }
    }

}