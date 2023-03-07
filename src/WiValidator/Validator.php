<?php

namespace wivalidator;

class Validator
{
    private $length = 8;

    public function __construct($length)
    {

        echo "hello";
        $this->length = $length;
    }
}