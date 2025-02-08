<?php

namespace App\Services;

use App\Utils\TripulanteValidator;
use App\Models\Tripulante;

class TripulanteService {
    
    public static function create(array $data) {
        $return = false;
        try {
            TripulanteValidator::validator($data);
            $return = Tripulante::save($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

}