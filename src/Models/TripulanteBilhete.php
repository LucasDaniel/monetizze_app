<?php

namespace App\Models;

use App\Models\Database;

class TripulanteBilhete extends Database {

    public static function save(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::insertTripulanteBilhete());
        $statement->execute([$data['id_tripulante'],$data['id_sorteio'],$data['numeros_escolhidos']]);
        return $pdo->lastInsertId() > 0;
    }

    public static function insertTripulanteBilhete() {
        return "INSERT INTO 
                    tripulante_bilhete (id_tripulante,id_sorteio,numeros_escolhidos)
                VALUES 
                    (?,?,?);";
    }

}
