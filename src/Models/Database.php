<?php

namespace App\Models;

use PDO;
use App\Models\Tripulante;
use App\Repositories\DatabaseRepository;

class Database {
    protected static function getConnection() {

        $host   = $_ENV['DB_HOST'];
        $port   = $_ENV['DB_PORT'];
        $dbname = $_ENV['DB_NAME'];
        $user   = $_ENV['DB_USER'];
        $pass   = $_ENV['DB_PASS'];

        return new PDO("pgsql:host=$host;port=$port;dbname=$dbname",$user,$pass);
    }

    public static function migrate() {
        $pdo = self::getConnection();
        $pdo->exec(DatabaseRepository::createTripulante());
        $pdo->exec(DatabaseRepository::createNumeroSorteado());
        $pdo->exec(DatabaseRepository::createTripulanteBilhete());
    }

    public static function seeder() {
        Tripulante::save(['nome'=>'Lucas']);
        Tripulante::save(['nome'=>'Daniel']);
        Tripulante::save(['nome'=>'Beltrame']);
        Tripulante::save(['nome'=>'Lima']);
        Tripulante::save(['nome'=>'Rodrigues']);
    }
}
