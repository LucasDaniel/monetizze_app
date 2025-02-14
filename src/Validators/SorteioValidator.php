<?php

namespace App\Validators;

use App\Validators\Validator;
use App\Models\Sorteio;
use App\Exceptions\IdSorteioNotExistsException;
use App\Exceptions\SorteioHappenedException;
use App\Enums\TypesEnum;
use App\Exceptions\SorteioNotHappenedException;

class SorteioValidator extends Validator {

    public static function verifyWinNumbers(array $data) {
        $fields = [
            'id_sorteio' => [ $data['id_sorteio'] ?? '', TypesEnum::INTEGER() ],
            'numeros_sorteados' => [ $data['numeros_sorteados'] ?? '', TypesEnum::STRING() ],
        ];

        self::validate($fields);
        self::verifyIdSorteioExists($fields);
        self::verifySorteioNotHappened($fields);
    }

    private static function returnVerifyIdSorteioExists(array $data) {
        return Sorteio::verifyIdSorteioExists($data);
    }

    public static function verifyIdSorteioExists(array $data) {
        $sorteioExists = self::returnVerifyIdSorteioExists($data);
        if (!$sorteioExists) {
            IdSorteioNotExistsException::exception();
        }
    }

    private static function returnVerifySorteioNotHappened(array $data) {
        return Sorteio::verifySorteioNotHappened($data);
    }

    public static function verifySorteioNotHappened(array $data) {
        $sorteioHappened = self::returnVerifySorteioNotHappened($data);
        if ($sorteioHappened) {
            SorteioHappenedException::exception();
        }
    }

    public static function verifySorteioHappened(array $data) {
        $sorteioHappened = self::returnVerifySorteioNotHappened($data);
        if (!$sorteioHappened) {
            SorteioNotHappenedException::exception();
        }
    }

    

}