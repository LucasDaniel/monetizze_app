<?php

namespace App\Controllers;

use App\Models\Database;

class HomeController {
    
    public function index() {
        echo "Hello World";
    }

    public function database() {
        print_r("executando migrate<br><br>");
        Database::migrate();
        print_r("<br><br>migrate executado");
    }

}
