<?php

namespace App\Models;

use PDO;
use App\Models\Database;
use App\Repositories\SorteioRepository;

class Sorteio extends Database {

    public static function save(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(SorteioRepository::rawInsertSorteio());
        $statement->bindParam(":numeros_sorteados", $data['numeros_sorteados'][0], PDO::PARAM_STR);
        $statement->execute();
        return $pdo->lastInsertId() > 0;
    }

    public static function updateSorteio($data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(SorteioRepository::rawUpdateSorteio());
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->bindParam(":numeros_sorteados", $data['numeros_sorteados'], PDO::PARAM_STR);
        $statement->execute();
        return $data;
    }

    public static function verifyIdSorteioExists($data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(SorteioRepository::rawSelectIdSorteioExists());
        $statement->bindParam(":id_sorteio", $data['id_sorteio'][0], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    public static function verifySorteioNotHappened($data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(SorteioRepository::rawVerifySorteioNotHappened());
        $statement->bindParam(":id_sorteio", $data['id_sorteio'][0], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    public static function selectSorteio($data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(SorteioRepository::rawSelectSorteio());
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}
