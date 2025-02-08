<?php

namespace App\Services;

use App\Utils\TripulanteBilheteValidator;
use App\Models\TripulanteBilhete;
use App\Services\SorteioService;

class TripulanteBilheteService {
    
    public static function create(array $data) {
        $return = false;
        try {
            TripulanteBilheteValidator::validator($data);
            $return = TripulanteBilhete::save($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

    public static function createRandomNumbers(array $data) {
        try {
            TripulanteBilheteValidator::validateTryRandomNumbers($data);
            $quantTryNumbers = $data['quantTryNumbers'];
            $quantNumbers = $data['quantNumbers'];
            while($quantTryNumbers > 0) {
                $data['numeros_escolhidos'] = SorteioService::generateNumbers($quantNumbers);
                $returnValidatorSameNumbers = TripulanteBilheteValidator::returnValidatorSameNumbers($data);
                if (!$returnValidatorSameNumbers) {
                    TripulanteBilhete::save($data);
                    $quantTryNumbers--;
                }
            }
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return 'Try numbers: '.$data['quantTryNumbers'].' - Quantity Numbers: '.$data['quantNumbers'];
    }

}