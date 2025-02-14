<?php

namespace App\Models;

use PDO;
use App\Models\Database;
use App\Repositories\TripulanteBilheteRepository;

class TripulanteBilhete extends Database {

    public static function save(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(TripulanteBilheteRepository::rawInsertTripulanteBilhete());
        $statement->bindParam(":id_tripulante", $data['id_tripulante'], PDO::PARAM_INT);
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->bindParam(":numeros_escolhidos", $data['numeros_escolhidos'], PDO::PARAM_STR);
        $statement->execute();
        return $pdo->lastInsertId() > 0;
    }

    public static function verifySameNumbersToSorteio(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(TripulanteBilheteRepository::rawSelectSameNumbersToSorteio());
        $statement->bindParam(":id_tripulante", $data['id_tripulante'], PDO::PARAM_INT);
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->bindParam(":numeros_escolhidos", $data['numeros_escolhidos'], PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    public static function validateQuantTryMaxNumbers(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(TripulanteBilheteRepository::rawSelectQuantTryMaxNumbers());
        $statement->bindParam(":id_tripulante", $data['id_tripulante'][0], PDO::PARAM_INT);
        $statement->bindParam(":id_sorteio", $data['id_sorteio'][0], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public static function selectTripulantesBilhetesSorteio(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(TripulanteBilheteRepository::rawSelectTripulantesBilhetesSorteio());
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } 

}
