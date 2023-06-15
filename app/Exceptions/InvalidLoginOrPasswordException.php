<?php

namespace App\Exceptions;

use Exception;

class InvalidLoginOrPasswordException extends Exception
{
    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'code' => 'AU02'
        ], 401);
    }  
}
