<?php

namespace App\Models;

use PDO;
use App\Models\Database;
use App\Repositories\TripulanteRepository;

class Tripulante extends Database {

    public static function save(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(TripulanteRepository::rawInsertTripulante());
        $statement->bindParam(":nome", $data['nome'], PDO::PARAM_STR);
        $statement->execute();
        return $pdo->lastInsertId() > 0;
    }

    public static function verifyIdTripulanteExists(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(TripulanteRepository::rawVerifyIdTripulanteExists());
        $statement->bindParam(":id_tripulante", $data['id_tripulante'][0], PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

}
