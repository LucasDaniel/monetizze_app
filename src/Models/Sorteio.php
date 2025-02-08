<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class Sorteio extends Database {

    public static function createEmpty() {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::insertSorteio());
        $statement->execute(['']);
        return $pdo->lastInsertId() > 0;
    }

    public static function save(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::insertSorteio());
        $statement->bindParam(":numeros_sorteados", $data['numeros_sorteados'], PDO::PARAM_STR);
        $statement->execute();
        return $pdo->lastInsertId() > 0;
    }

    public static function insertSorteio() {
        return "INSERT INTO 
                    sorteio (numeros_sorteados)
                VALUES 
                    (:numeros_sorteados)";
    }

}
