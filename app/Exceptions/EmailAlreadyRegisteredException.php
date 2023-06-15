<?php

namespace App\Exceptions;

use Exception;

class EmailAlreadyRegisteredException extends Exception
{
    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'code' => 'AU01'
        ], 400);
    }
}
