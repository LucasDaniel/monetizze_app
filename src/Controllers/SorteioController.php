<?php

namespace App\Controllers;

use App\Http\Request;
use App\Controllers\Controller;
use App\Services\SorteioService;

class SorteioController extends Controller {
    
    public function store(Request $request) {
       
        $body = $request::body();

        $sorteioCreate = SorteioService::createEmpty();

        return self::verifyDataAndReturn($sorteioCreate);
        
    }

    public function generateWinNumbers(Request $request) {
       
        $body = $request::body();

        $sorteioWinNumbers = SorteioService::updateSorteio($body);

        return self::verifyDataAndReturn($sorteioWinNumbers);
        
    }

}
