<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class TripulanteBilhete extends Database {

    public static function save(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::insertTripulanteBilhete());
        $statement->bindParam(":id_tripulante", $data['id_tripulante'], PDO::PARAM_INT);
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->bindParam(":numeros_escolhidos", $data['numeros_escolhidos'], PDO::PARAM_STR);
        $statement->execute();
        return $pdo->lastInsertId() > 0;
    }

    private static function insertTripulanteBilhete() {
        return "INSERT INTO 
                    tripulante_bilhete (id_tripulante,id_sorteio,numeros_escolhidos)
                VALUES 
                    (:id_tripulante,:id_sorteio,:numeros_escolhidos);";
    }

    public static function verifySameNumbersToSorteio(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::selectSameNumbersToSorteio());
        $statement->bindParam(":id_tripulante", $data['id_tripulante'], PDO::PARAM_INT);
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->bindParam(":numeros_escolhidos", $data['numeros_escolhidos'], PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    private static function selectSameNumbersToSorteio() {
        return "SELECT count(*)
                FROM tripulante_bilhete
                WHERE 
                    id_tripulante = :id_tripulante AND
                    id_sorteio = :id_sorteio AND
                    numeros_escolhidos LIKE :numeros_escolhidos";
    }

}
