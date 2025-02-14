<?php

namespace App\Validators;

use App\Validators\Validator;
use App\Models\Tripulante;
use App\Enums\TypesEnum;

class HtmlValidator extends Validator {

    public static function validator(array $data) {

        $fields = [
            'id_sorteio' => [ $data['id_sorteio'] ?? '', TypesEnum::INTEGER->value ],
        ];

        self::validate($fields);
        SorteioValidator::verifySorteioHappened($fields);
        SorteioValidator::verifyIdSorteioExists($fields);
    }

}