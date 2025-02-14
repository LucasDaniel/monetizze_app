<?php

namespace App\Repositories;

class DatabaseRepository {

    public static function createTripulante() {
        print_r("executando createTripulante<br><br>");
        return "CREATE TABLE IF NOT EXISTS 
                        tripulante (
                            id  SERIAL PRIMARY KEY,
                            nome VARCHAR(255) UNIQUE
                        );";
    }

    public static function createTripulanteBilhete() {
        print_r("executando createTripulanteBilhete<br><br>");
        return "CREATE TABLE IF NOT EXISTS 
                        tripulante_bilhete (
                            id SERIAL PRIMARY KEY,
                            id_tripulante INTEGER REFERENCES tripulante,
                            id_sorteio INTEGER REFERENCES sorteio,
                            numeros_escolhidos VARCHAR(255)
                        );";
    }

    public static function createNumeroSorteado() {
        print_r("executando createNumeroSorteado<br><br>");
        return "CREATE TABLE IF NOT EXISTS 
                        sorteio (
                            id SERIAL PRIMARY KEY,
                            numeros_sorteados VARCHAR(255)
                        );";
    }
}