<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class TripulanteBilhete extends Database {

    public static function save(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::rawInsertTripulanteBilhete());
        $statement->bindParam(":id_tripulante", $data['id_tripulante'], PDO::PARAM_INT);
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->bindParam(":numeros_escolhidos", $data['numeros_escolhidos'], PDO::PARAM_STR);
        $statement->execute();
        return $pdo->lastInsertId() > 0;
    }

    private static function rawInsertTripulanteBilhete() {
        return "INSERT INTO 
                    tripulante_bilhete (id_tripulante,id_sorteio,numeros_escolhidos)
                VALUES 
                    (:id_tripulante,:id_sorteio,:numeros_escolhidos);";
    }

    public static function verifySameNumbersToSorteio(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::rawSelectSameNumbersToSorteio());
        $statement->bindParam(":id_tripulante", $data['id_tripulante'], PDO::PARAM_INT);
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->bindParam(":numeros_escolhidos", $data['numeros_escolhidos'], PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    private static function rawSelectSameNumbersToSorteio() {
        return "SELECT 
                    count(*)
                FROM 
                    tripulante_bilhete
                WHERE 
                    id_tripulante = :id_tripulante AND
                    id_sorteio = :id_sorteio AND
                    numeros_escolhidos LIKE :numeros_escolhidos";
    }

    public static function validateQuantTryMaxNumbers(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::rawSelectQuantTryMaxNumbers());
        $statement->bindParam(":id_tripulante", $data['id_tripulante'][0], PDO::PARAM_INT);
        $statement->bindParam(":id_sorteio", $data['id_sorteio'][0], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn();
    }

    private static function rawSelectQuantTryMaxNumbers() {
        return "SELECT 
                    count(*)
                FROM 
                    tripulante_bilhete
                WHERE 
                    id_tripulante = :id_tripulante AND
                    id_sorteio = :id_sorteio";
    }

    public static function selectTripulantesBilhetesSorteio(array $data) {
        $pdo = self::getConnection();
        $statement = $pdo->prepare(self::rawSelectTripulantesBilhetesSorteio());
        $statement->bindParam(":id_sorteio", $data['id_sorteio'], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }  

    private static function rawSelectTripulantesBilhetesSorteio() {

        return "SELECT t.nome, tb.numeros_escolhidos, 
                    CASE WHEN ((LENGTH(tb.numeros_escolhidos) - LENGTH(REPLACE(tb.numeros_escolhidos, ',', '')) + 1) > 9) THEN
                        CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',10) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',10) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',10) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',10) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',10) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',10) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END END
                    ELSE CASE WHEN ((LENGTH(tb.numeros_escolhidos) - LENGTH(REPLACE(tb.numeros_escolhidos, ',', '')) + 1) > 8) THEN
                        CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',9) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END END
                    ELSE CASE WHEN ((LENGTH(tb.numeros_escolhidos) - LENGTH(REPLACE(tb.numeros_escolhidos, ',', '')) + 1) > 7) THEN
                        CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',8) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END END
                    ELSE CASE WHEN ((LENGTH(tb.numeros_escolhidos) - LENGTH(REPLACE(tb.numeros_escolhidos, ',', '')) + 1) > 6) THEN
                        CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',7) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END END
                    ELSE CASE WHEN TRUE THEN
                        CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',1) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',2) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',3) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',4) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',5) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END +
                        CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',1) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',2) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',3) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',4) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',5) :: INTEGER) THEN 1
                        ELSE CASE WHEN (split_part(s.numeros_sorteados, ',',6) :: INTEGER = split_part(tb.numeros_escolhidos, ',',6) :: INTEGER) THEN 1
                        ELSE 0 END END END END END END
                    ELSE 0 END END END END END AS ACERTOS
                FROM 
                    tripulante_bilhete tb
                    INNER JOIN tripulante t ON t.id = tb.id_tripulante
                    INNER JOIN sorteio s ON s.id = tb.id_sorteio
                WHERE 
                    tb.id_sorteio = :id_sorteio
                ORDER BY ACERTOS DESC";

    }

}
