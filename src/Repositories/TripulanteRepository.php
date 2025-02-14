<?php

namespace App\Repositories;

class TripulanteRepository {

    public static function rawInsertTripulante() {
        return "INSERT INTO 
                    tripulante (nome)
                VALUES 
                    (:nome)";
    }

    public static function rawVerifyIdTripulanteExists() {
        return "SELECT 
                    count(*)
                FROM 
                    tripulante
                WHERE 
                    id = :id_tripulante ";
    }

}
