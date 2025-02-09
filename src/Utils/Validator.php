<?php

namespace App\Utils;

class Validator {

    protected static function validate(array $fields) {
        foreach ($fields as $field => $value) {
            if (empty(trim($value[0]))) {
                throw new \Exception("O campo ($field) é requerido");
            }
            if (gettype($value[0]) != $value[1]) {
                throw new \Exception("O campo ($field) não é do tipo $value[1] ele é ".gettype($value[0]));
            }
            if ($value[1] == 'string' && ctype_digit($value[0])) {
                throw new \Exception("O campo ($field) de valor '$value[0]' ele não é um $value[1]");
            }
        }
    }

}