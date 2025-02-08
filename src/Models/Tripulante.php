<?php

namespace App\Models;

use App\Models\Database;

class Tripulante extends Database {

    public static function save(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::insertTripulante());
        $statement->execute([$data['name']]);
        return $pdo->lastInsertId() > 0;
    }

    public static function insertTripulante() {
        return "INSERT INTO 
                    tripulante (nome)
                VALUES 
                    (?);";
    }

}
