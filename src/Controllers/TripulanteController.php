<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Controllers\Controller;
use App\Services\TripulanteService;

class TripulanteController extends Controller {
    
    public function store(Request $request, Response $response) {
       
        $body = $request::body();

        $tripulanteCreate = TripulanteService::create($body);

        return self::verifyDataAndReturn($tripulanteCreate);
        
    }


}
