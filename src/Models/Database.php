<?php

namespace App\Models;

use PDO;
use App\Models\Tripulante;

class Database {
    protected static function getConnection() {

        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];

        return new PDO("pgsql:host=$host;port=$port;dbname=$dbname",$user,$pass);
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
                            nome VARCHAR(255) UNIQUE
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
        Tripulante::save(['nome'=>'Lucas']);
        Tripulante::save(['nome'=>'Daniel']);
        Tripulante::save(['nome'=>'Beltrame']);
        Tripulante::save(['nome'=>'Lima']);
        Tripulante::save(['nome'=>'Rodrigues']);
    }
}
