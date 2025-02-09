<?php

namespace App\Services;

use App\Validators\HtmlValidator;

use App\Models\Sorteio;
use App\Models\TripulanteBilhete;

use PDOException;

class HtmlService {
    
    public static function generate(array $data) {
        $return = false;
        try {
            HtmlValidator::validator($data);
            $return = [
                'sorteio' => Sorteio::selectSorteio($data),
                'tripulante_bilhetes' => TripulanteBilhete::selectTripulantesBilhetesSorteio($data)
            ];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

}