<?php

namespace App\Models;

use PDO;

class Database {
    public static function getConnection() {
        return new PDO("pgsql:host=host.docker.internal;port=5432;dbname=monetizze","root","root");
    }

    public static function migrate() {
        $pdo = self::getConnection();
        $pdo->exec(self::createTripulante());
        $pdo->exec(self::createNumeroSorteado());
        $pdo->exec(self::createTripulanteBilhete());
    }

    private static function createTripulante() {
        print_r("executando createTripulante<br><br>");
        return "CREATE TABLE IF NOT EXISTS 
                        tripulante (
                            id  SERIAL PRIMARY KEY,
                            nome VARCHAR(255) 
                        );";
    }

    private static function createTripulanteBilhete() {
        print_r("executando createTripulanteBilhete<br><br>");
        return "CREATE TABLE IF NOT EXISTS 
                        tripulante_bilhete (
                            id SERIAL PRIMARY KEY,
                            id_tripulante INTEGER REFERENCES tripulante,
                            id_sorteio INTEGER REFERENCES sorteio,
                            numeros_escolhidos VARCHAR(255)
                        );";
    }

    private static function createNumeroSorteado() {
        print_r("executando createNumeroSorteado<br><br>");
        return "CREATE TABLE IF NOT EXISTS 
                        sorteio (
                            id SERIAL PRIMARY KEY,
                            numeros_sorteados VARCHAR(255)
                        );";
    }

    public static function seeder() {
        $pdo = self::getConnection();
        $pdo->exec(self::seederTripulantes('Lucas'));
        $pdo->exec(self::seederTripulantes('Daniel'));
        $pdo->exec(self::seederTripulantes('Beltrame'));
        $pdo->exec(self::seederTripulantes('Lima'));
        $pdo->exec(self::seederTripulantes('Rodrigues'));
    }

    private static function seederTripulantes(string $name) {
        print_r("executando seederTripulantes $name <br><br>");
        return "INSERT INTO 
                    tripulante (nome)
                VALUES 
                    ('$name');";
    }
}
