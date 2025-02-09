<?php

namespace App\Controllers;

use App\Http\Request;
use App\Services\HtmlService;

class HtmlController extends Controller {
    
    public function generateHTML(Request $request) {
       
        $body = $request::body();

        $htmlGenerate = HtmlService::generate($body);
        
        return self::verifyDataAndReturn($htmlGenerate);
    }

}
