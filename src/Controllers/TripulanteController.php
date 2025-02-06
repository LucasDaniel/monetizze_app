<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\TripulanteService;

class TripulanteController {
    
    public function store(Request $request, Response $response) {
       
        $body = $request::body();

        $tripulanteService = TripulanteService::create($body);

        if (isset($tripulanteService['error'])) {
            return $response::json([
                'error' => true,
                'success' => false,
                'data' => $tripulanteService['error'],
            ],400);
        }

        $response::json([
            'error' => false,
            'success' => true,
            'data' => $body,
        ],201);
        
    }


}
