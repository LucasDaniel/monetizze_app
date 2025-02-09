<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class Sorteio extends Database {

    public static function save(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::rawInsertSorteio());
        $statement->bindParam(":numeros_sorteados", $data['numeros_sorteados'], PDO::PARAM_STR);
        $statement->execute();
        return $pdo->lastInsertId() > 0;
    }

    private static function rawInsertSorteio() {
        return "INSERT INTO 
                    sorteio (numeros_sorteados)
                VALUES 
                    (:numeros_sorteados)";
    }

    public static function updateSorteio($data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::rawUpdateSorteio());
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->bindParam(":numeros_sorteados", $data['numeros_sorteados'], PDO::PARAM_STR);
        $statement->execute();
        return $data;
    }

    private static function rawUpdateSorteio() {
        return "UPDATE 
                    sorteio
                SET 
                    numeros_sorteados = :numeros_sorteados
                WHERE 
                    id = :id_sorteio";
    }

    public static function verifyIdSorteioExists($data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::rawSelectIdSorteioExists());
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    private static function rawSelectIdSorteioExists() {
        return "SELECT 
                    count(*)
                FROM 
                    sorteio
                WHERE 
                    id = :id_sorteio";
    }

    public static function verifySorteioHappened($data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::rawVerifySorteioHappened());
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    private static function rawVerifySorteioHappened() {
        return "SELECT 
                    count(*)
                FROM 
                    sorteio
                WHERE 
                    id = :id_sorteio AND 
                    numeros_sorteados != ''";
    }

}
