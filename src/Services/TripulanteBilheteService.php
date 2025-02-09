<?php

namespace App\Services;

use App\Validators\TripulanteBilheteValidator;
use App\Models\TripulanteBilhete;
use App\Services\SorteioService;

use PDOException;

class TripulanteBilheteService {

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
        } catch (PDOException $e) {
            if ($e->errorInfo[0] == 23503) return ['error' => "Valor não encontrado na tabela"];
            return ['error' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return 'Try numbers: '.$data['quantTryNumbers'].' - Quantity Numbers: '.$data['quantNumbers'];
    }

}