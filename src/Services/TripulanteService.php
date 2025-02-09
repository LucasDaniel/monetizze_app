<?php

namespace App\Services;

use App\Utils\TripulanteValidator;
use App\Models\Tripulante;

use PDOException;

class TripulanteService {
    
    public static function create(array $data) {
        $return = false;
        try {
            TripulanteValidator::validator($data);
            $return = Tripulante::save($data);
        } catch (PDOException $e) {
            if ($e->errorInfo[0] == 23505) return ['error' => explode('=',$e->errorInfo[2])[1]];
            return ['error' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

}