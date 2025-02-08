<?php

namespace App\Services;

use App\Utils\SorteioValidator;
use App\Models\Sorteio;

class SorteioService {
    
    public static function createEmpty() {
        $return = false;
        try {
            $return = Sorteio::createEmpty();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

}