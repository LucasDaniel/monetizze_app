<?php

namespace App\Utils;

class Validator {

    protected static function validate(array $fields) {
        foreach ($fields as $field => $value) {
            if (empty(trim($value))) {
                throw new \Exception("O campo ($field) é requerido");
            }
        }
        return $fields;
    }

}