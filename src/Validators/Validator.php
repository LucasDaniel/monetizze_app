<?php

namespace App\Validators;

use App\Exceptions\FieldRequiredException;
use App\Exceptions\FieldTypeException;
use App\Exceptions\FieldNotTypeException;
use App\Enums\TypesEnum;

class Validator {

    protected static function validate(array $fields) {
        foreach ($fields as $field => $value) {
            if (empty(trim($value[0]))) {
                FieldRequiredException::exception(['field'=>$field]);
            }
            if (gettype($value[0]) != $value[1]) {
                FieldTypeException::exception(['field'=>$field,'type'=>$value[1],'gettype'=>gettype($value[0])]);
            }
            if ($value[1] == TypesEnum::STRING() && ctype_digit($value[0])) {
                FieldNotTypeException::exception(['field'=>$field,'value'=>$value[0],'type'=>$value[1]]);
            }
        }
    }

}