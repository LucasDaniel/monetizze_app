<?php

namespace App\Models;

use App\Models\Database;

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
        $statement->execute([$data['numeros_sorteados']]);
        return $pdo->lastInsertId() > 0;
    }

    public static function insertSorteio() {
        return "INSERT INTO 
                    sorteio (numeros_sorteados)
                VALUES 
                    (?);";
    }

}
