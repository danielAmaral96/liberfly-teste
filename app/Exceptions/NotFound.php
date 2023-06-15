<?php

namespace App\Exceptions;

use Exception;

class NotFound extends Exception
{
    public function render(){
        return response()->json([
            'error' => 'No data has been found',
            'code' => '404'
        ], 200);
    }
}
