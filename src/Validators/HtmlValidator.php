<?php

namespace App\Validators;

use App\Validators\Validator;
use App\Models\Tripulante;
use App\Validators\SorteioValidator;

class HtmlValidator extends Validator {

    public static function validator(array $data) {

        $fields = [
            'id_sorteio' => [ $data['id_sorteio'] ?? '', 'integer' ],
        ];

        self::validate($fields);
        SorteioValidator::verifySorteioHappened($fields);
        SorteioValidator::verifyIdSorteioExists($fields);
    }

}