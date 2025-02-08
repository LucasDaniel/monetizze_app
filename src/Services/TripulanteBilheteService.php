<?php

namespace App\Services;

use App\Utils\TripulanteBilheteValidator;
use App\Models\TripulanteBilhete;

class TripulanteBilheteService {
    
    public static function create(array $data) {
        $return = false;
        try {
            $fields = TripulanteBilheteValidator::validator($data);
            if ($fields) $return = TripulanteBilhete::save($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

}