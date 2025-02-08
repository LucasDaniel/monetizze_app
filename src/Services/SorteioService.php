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

    public static function updateSorteio() {
        $return = false;
        try {
            $prizeNumbers = self::generateNumbers();
            $return = Sorteio::updateSorteio($prizeNumbers);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

    /**
     * Gera os numeros a partir da quantidade enviada por parametro
     */
    public static function generateNumbers($quantNumbers) {

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