<?php

namespace App\Utils;

use App\Utils\Validator;
use App\Models\Sorteio;
use App\Exceptions\IdSorteioNotExistsException;

class SorteioValidator extends Validator {

    public static function verifyWinNumbers(array $data) {
        $fields = [
            'id_sorteio' => [ $data['id_sorteio'] ?? '', 'integer' ],
            'numeros_sorteados' => [ $data['numeros_sorteados'] ?? '', 'string' ],
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
            throw new \Exception("O sorteio já foi concluido");
        }
    }

    

}