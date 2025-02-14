<?php

namespace App\Validators;

use App\Validators\Validator;
use App\Validators\SorteioValidator;
use App\Validators\TripulanteValidator;
use App\Models\TripulanteBilhete;
use App\Exceptions\ValidateQuantNumbersException;
use App\Exceptions\ValidateQuantTryNumbersGreaterThanZero;
use App\Exceptions\ValidateQuantTryNumbersLessThanFiftyOne;
use App\Exceptions\ValidatorSameNumbers;
use App\Enums\ErrorsEnum;
use App\Enums\RulesEnum;
use App\Enums\TypesEnum;
use App\Exceptions\ValidateQuantTryNumbersGreaterThanZeroException;
use App\Exceptions\ValidateQuantTryNumbersLessThanFiftyOneException;
use App\Exceptions\ValidatorSameNumbersException;

class TripulanteBilheteValidator extends Validator {

    public static function validateTryRandomNumbers(array $data) {

        $fields = [
            'id_tripulante' => [ $data['id_tripulante'] ?? '', TypesEnum::INTEGER->value ],
            'id_sorteio' => [ $data['id_sorteio'] ?? '', TypesEnum::INTEGER->value ],
            'quantTryNumbers' => [ $data['quantTryNumbers'] ?? '', TypesEnum::INTEGER->value ],
            'quantNumbers' => [ $data['quantNumbers'] ?? '', TypesEnum::INTEGER->value ],
        ];
        
        self::validate($fields);
        SorteioValidator::verifySorteioNotHappened($fields);
        self::validateQuantNumbers($data);
        self::validateQuantTryNumbers($data);
        self::validateQuantTryMaxNumbers($fields);
    }

    private static function validateQuantNumbers(array $data) {
        if ($data['quantNumbers'] < RulesEnum::MIN_QUANT_NUMBERS->value || 
            $data['quantNumbers'] > RulesEnum::MAX_QUANT_NUMBERS->value) {
            ValidateQuantNumbersException::exception();
        }
    }

    private static function validateQuantTryNumbers(array $data) {
        if ($data['quantTryNumbers'] < RulesEnum::MIN_TRY_NUMBERS->value) {
            ValidateQuantTryNumbersGreaterThanZero::exception();
        }
        if ($data['quantTryNumbers'] > RulesEnum::MAX_TRY_NUMBERS->value) {
            ValidateQuantTryNumbersLessThanFiftyOne::exception();
        }
    }

    private static function validateQuantTryMaxNumbers(array $data) {
        $numbersTry = TripulanteBilhete::validateQuantTryMaxNumbers($data);
        if (($numbersTry + $data['quantTryNumbers'][0]) > RulesEnum::MAX_TRY_NUMBERS->value) {
            ValidateQuantTryNumbersLessThanFiftyOne::exception();
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