<?php

namespace App\Controllers;

use App\Http\Request;
use App\Services\HtmlService;
use App\Http\Response;

class HtmlController extends Controller {
    
    public function generateHTML(Request $request) {
       
        $body = $request::body();

        $json = HtmlService::generateJson($body);

        if (isset($json['error']) || !$json) {
            return self::verifyDataAndReturn($json);
        }

        $html = HtmlService::generateHTML($json);

        echo $html;

        return;
    }

}
