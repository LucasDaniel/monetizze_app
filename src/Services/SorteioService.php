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
            $prizeNumbers = self::generateWinNumbers();
            $return = Sorteio::updateSorteio($prizeNumbers);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return $return;
    }

    private static function generateWinNumbers() {

        //Cria as variaveis de controle
        $chosenNumberArr = [0,0,0,0,0,0];
        $quantChosenNumbers = 0;
        $chosenNumber = -1;

        //Escolhe os numeros e guarda eles no array
        while($quantChosenNumbers < 6) {
            $chosenNumber = rand(1,60);
            if (!in_array($chosenNumber,$chosenNumberArr)) {
                $chosenNumberArr[$quantChosenNumbers] = $chosenNumber;
                $quantChosenNumbers++;
            }
        }
        //Organiza os numeros na ordem crescente
        sort($chosenNumberArr);

        //Gera o array do sorteio
        $prizeNumbers = implode(',', $chosenNumberArr);

        return $prizeNumbers;
    }

}