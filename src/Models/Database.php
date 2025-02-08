<?php

namespace App\Models;

use PDO;

class Database {
    public static function getConnection() {
        return new PDO("pgsql:host=host.docker.internal;port=5432;dbname=monetizze","root","root");
    }

    public static function migrate() {
        $pdo = self::getConnection();
        $pdo->exec("CREATE TABLE Personsaaaaa (
                        PersonID int,
                        LastName varchar(255),
                        FirstName varchar(255),
                        Address varchar(255),
                        City varchar(255)
                    );");
    }

    private function createTables() {
        $create = "CREATE TABLE Persons (
                        PersonID int,
                        LastName varchar(255),
                        FirstName varchar(255),
                        Address varchar(255),
                        City varchar(255)
                    );";
        return $create;
    }
}
