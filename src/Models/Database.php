<?php

namespace App\Models;

use PDO;
use App\Models\Tripulante;

class Database {
    protected static function getConnection() {

        $host = 'host.docker.internal';
        $port = '5432';
        $dbname = 'monetizze';
        $user = 'root';
        $pass = 'root';

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
        Tripulante::save(['name'=>'Lucas']);
        Tripulante::save(['name'=>'Daniel']);
        Tripulante::save(['name'=>'Beltrame']);
        Tripulante::save(['name'=>'Lima']);
        Tripulante::save(['name'=>'Rodrigues']);
    }
}
