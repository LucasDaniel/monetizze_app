<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\TripulanteService;

class TripulanteController {

    public function teste(Request $request, Response $response) {
        return "pqp";
    }
    
    public function store(Request $request, Response $response) {
       
        $body = $request::body();

        $tripulanteCreate = TripulanteService::create($body);

        if (isset($tripulanteCreate['error']) || !$tripulanteCreate) {
            return $response::json([
                'error' => true,
                'success' => false,
                'data' => $tripulanteCreate['error'] ?? $tripulanteCreate,
            ],400);
        }

        return $response::json([
            'error' => false,
            'success' => true,
            'data' => $body,
        ],201);
        
    }


}
