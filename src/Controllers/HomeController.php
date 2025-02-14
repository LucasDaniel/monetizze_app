<?php

namespace App\Controllers;

use App\Models\Database;

class HomeController {

    public function index(){
        echo "Hello world";
    }

    public function migrate() {
        print_r("executando migrate<br><br>");
        Database::migrate();
        print_r("<br><br>migrate executado");
    }

    public function seeder() {
        print_r("executando seeder<br><br>");
        Database::seeder();
        print_r("<br><br>seeder executado");
    }

}
