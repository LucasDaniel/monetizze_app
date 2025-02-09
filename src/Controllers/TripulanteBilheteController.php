<?php

namespace App\Controllers;

use App\Http\Request;
use App\Controllers\Controller;
use App\Services\TripulanteBilheteService;

class TripulanteBilheteController extends Controller {

    public function createRandomNumbers(Request $request) {

        $body = $request::body();

        $tripulanteBilheteCreate = TripulanteBilheteService::createRandomNumbers($body);

        return self::verifyDataAndReturn($tripulanteBilheteCreate);

    }

}
