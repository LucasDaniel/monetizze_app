<?php

namespace App\Services;

use App\Validators\TripulanteValidator;
use App\Models\Tripulante;
use App\Enums\ErrorsEnum;

use PDOException;

class TripulanteService extends BaseService {
    
    public static function create(array $data) {
        $return = false;
        try {
            TripulanteValidator::validator($data);
            $return = Tripulante::save($data);
        } catch (PDOException $e) {
            if ($e->errorInfo[0] == ErrorsEnum::DUPLICATE_ID->value) return ['error' => explode('=',$e->errorInfo[2])[1]];
            return ['error' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

}