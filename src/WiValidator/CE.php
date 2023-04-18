<?php

namespace track;
 
use Exception;
class CE extends Exception
{   
    public function render($request)
    {       
        return response()->json(["message" => $this->getMessage()]);       
    }
}