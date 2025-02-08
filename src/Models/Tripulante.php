<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class Tripulante extends Database {

    public static function save(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::rawInsertTripulante());
        $statement->bindParam(":nome", $data['nome'], PDO::PARAM_STR);
        $statement->execute();
        return $pdo->lastInsertId() > 0;
    }

    private static function rawInsertTripulante() {
        return "INSERT INTO 
                    tripulante (nome)
                VALUES 
                    (:nome)";
    }

}
