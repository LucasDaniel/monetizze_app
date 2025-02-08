<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class NotFoundController {
    
    public function index(Request $request) {
        Response::json([
            'error' => true,
            'success' => false,
            'message' => "Method not allowed",
        ],405);
        return;
    }

}
