<?php

namespace App\Services;

use App\Validators\SorteioValidator;
use App\Models\Sorteio;

class SorteioService extends BaseService {
    
    public static function createEmpty() {
        $return = false;
        try {
            $data['numeros_sorteados'][0] = "";
            $return = Sorteio::save($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

    public static function updateSorteio(array $data) {
        $return = false;
        try {
            $data['numeros_sorteados'] = self::generateNumbers();
            SorteioValidator::verifyWinNumbers($data);
            $return = Sorteio::updateSorteio($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

    /**
     * Gera os numeros a partir da quantidade enviada por parametro
     */
    public static function generateNumbers(int $quantNumbers = 6) {

        //Cria as variaveis de controle
        $chosenNumberArr = [];
        for($i = 0; $i < $quantNumbers; $i++) $chosenNumberArr[$i] = 0;
        $quantChosenNumbers = 0;
        $chosenNumber = -1;

        //Escolhe os numeros e guarda eles no array
        while($quantChosenNumbers < $quantNumbers) {
            $chosenNumber = rand(1,60);
            if (!in_array($chosenNumber,$chosenNumberArr)) {
                $chosenNumberArr[$quantChosenNumbers] = $chosenNumber;
                $quantChosenNumbers++;
            }
        }
        
        //Organiza os numeros na ordem crescente
        sort($chosenNumberArr);

        //Gera o string a partir do array do sorteio
        $prizeNumbers = implode(',', $chosenNumberArr);

        return $prizeNumbers;
    }

}