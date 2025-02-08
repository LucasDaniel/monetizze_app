<?php

namespace App\Controllers;

use App\Http\Request;
use App\Controllers\Controller;
use App\Services\TripulanteBilheteService;

class TripulanteBilheteController extends Controller {
    
    public function store(Request $request) {
       
        $body = $request::body();

        $tripulanteBilheteCreate = TripulanteBilheteService::create($body);

        return self::verifyDataAndReturn($tripulanteBilheteCreate);
        
    }

    public function createRandomNumbers(Request $request) {

        $body = $request::body();

        $tripulanteBilheteCreate = TripulanteBilheteService::createRandomNumbers($body);

        return self::verifyDataAndReturn($tripulanteBilheteCreate);

    }

}
