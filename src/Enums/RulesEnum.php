<?php

namespace App\Enums;

class RulesEnum {

    public static function MAX_TRY_NUMBERS(): int {
        return 50;
    }
    public static function MIN_TRY_NUMBERS(): int {
        return 1;
    }
    public static function MIN_QUANT_NUMBERS(): int {
        return 6;
    }
    public static function MAX_QUANT_NUMBERS(): int {
        return 10;
    }

}
