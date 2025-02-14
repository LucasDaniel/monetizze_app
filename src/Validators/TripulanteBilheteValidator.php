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
use App\Enums\ErrorsEnum;
use App\Enums\RulesEnum;
use App\Enums\TypesEnum;

class TripulanteBilheteValidator extends Validator {

    public static function validateTryRandomNumbers(array $data) {

        $fields = [
            'id_tripulante' => [ $data['id_tripulante'] ?? '', TypesEnum::INTEGER() ],
            'id_sorteio' => [ $data['id_sorteio'] ?? '', TypesEnum::INTEGER() ],
            'quantTryNumbers' => [ $data['quantTryNumbers'] ?? '', TypesEnum::INTEGER() ],
            'quantNumbers' => [ $data['quantNumbers'] ?? '', TypesEnum::INTEGER() ],
        ];
        
        self::validate($fields);
        SorteioValidator::verifySorteioNotHappened($fields);
        self::validateQuantNumbers($data);
        self::validateQuantTryNumbers($data);
        self::validateQuantTryMaxNumbers($fields);
    }

    private static function validateQuantNumbers(array $data) {
        if ($data['quantNumbers'] < RulesEnum::MIN_QUANT_NUMBERS() || 
            $data['quantNumbers'] > RulesEnum::MAX_QUANT_NUMBERS()) {
            ValidateQuantNumbersException::exception();
        }
    }

    private static function validateQuantTryNumbers(array $data) {
        if ($data['quantTryNumbers'] < RulesEnum::MIN_TRY_NUMBERS()) {
            ValidateQuantTryNumbersGreaterThanZeroException::exception();
        }
        if ($data['quantTryNumbers'] > RulesEnum::MAX_TRY_NUMBERS()) {
            ValidateQuantTryNumbersLessThanFiftyOneException::exception();
        }
    }

    private static function validateQuantTryMaxNumbers(array $data) {
        $numbersTry = TripulanteBilhete::validateQuantTryMaxNumbers($data);
        if (($numbersTry + $data['quantTryNumbers'][0]) > RulesEnum::MAX_TRY_NUMBERS()) {
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