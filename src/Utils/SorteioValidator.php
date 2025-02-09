<?php

namespace App\Utils;

use App\Utils\Validator;
use App\Models\Sorteio;

class SorteioValidator extends Validator {

    public static function validator(array $data) {
        $fields = [
            'numeros_sorteados' => $data['numeros_sorteados'] ?? '',
        ];

        self::validate($fields);
    }

    public static function verifyWinNumbers(array $data) {
        $fields = [
            'id_sorteio' => $data['id_sorteio'] ?? '',
            'numeros_sorteados' => $data['numeros_sorteados'] ?? '',
        ];

        self::validate($fields);
        self::verifyIdSorteioExists($fields);
        return self::verifySorteioNotHappened($fields);
    }

    private static function verifyIdSorteioExists(array $data) {
        $sorteioExists = Sorteio::verifyIdSorteioExists($data);
        if (!$sorteioExists) {
            throw new \Exception("O Id do sorteio não existe");
        }
    }

    private static function verifySorteioNotHappened(array $data) {
        $sorteioHappened = Sorteio::verifySorteioHappened($data);
        if ($sorteioHappened) {
            throw new \Exception("O sorteio já foi concluido");
        }
    }

    

}