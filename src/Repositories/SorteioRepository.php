<?php

namespace App\Repositories;

class SorteioRepository {

    public static function rawInsertSorteio() {
        return "INSERT INTO 
                    sorteio (numeros_sorteados)
                VALUES 
                    (:numeros_sorteados)";
    }

    public static function rawUpdateSorteio() {
        return "UPDATE 
                    sorteio
                SET 
                    numeros_sorteados = :numeros_sorteados
                WHERE 
                    id = :id_sorteio";
    }

    public static function rawSelectIdSorteioExists() {
        return "SELECT 
                    count(*)
                FROM 
                    sorteio
                WHERE 
                    id = :id_sorteio";
    }

    public static function rawVerifySorteioNotHappened() {
        return "SELECT 
                    count(*)
                FROM 
                    sorteio
                WHERE 
                    id = :id_sorteio AND 
                    numeros_sorteados != ''";
    }

    public static function rawSelectSorteio() {
        return "SELECT 
                    *
                FROM 
                    sorteio
                WHERE 
                    id = :id_sorteio";
    }

}
