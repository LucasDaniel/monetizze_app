<?php

namespace App\Models;

use PDO;

class Database {
    public function getConnection() {
        $pdo = new PDO("sqlite:database.db");
        return $pdo;
    }

    public static function migrate() {
        $pdo = new PDO("sqlite:database.db");
        print_r("<br><br>");
        print_r($pdo);
        $pdo->exec("CREATE TABLE Personsaaa (
                        PersonID int,
                        LastName varchar(255),
                        FirstName varchar(255),
                        Address varchar(255),
                        City varchar(255)
                    );");
        print_r("<br><br>Comitando...");
        //$pdo->commit();
        print_r("<br><br>");
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
