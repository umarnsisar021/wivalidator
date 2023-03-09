<?php

namespace wivalidator;
 
use Exception;
class CustomException extends Exception
{   
    public function render($request)
    {       
        return response()->json(["message" => $this->getMessage()]);       
    }
}