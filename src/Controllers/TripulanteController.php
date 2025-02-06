<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class TripulanteController {
    
    public function store(Request $request, Response $response) {
       
        $body = $request::body();

        $response::json([
            'error' => false,
            'success' => true,
            'data' => $body,
        ],201);
        
    }


}
