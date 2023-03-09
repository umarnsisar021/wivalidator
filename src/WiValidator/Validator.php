<?php

namespace wivalidator;
use App\Http\Requests\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
class Validator
{
    public function __construct()
    {
       $Host = request()->getHost(); 
       if(!Hash::check($Host , '$2a$12$gsNDk7qRKilvt./T0.3AGeZa3AJc1Gxq4NbESIscll7zSLJSpps6m')){
         throw new CustomException('This application is licensed only for www.clicktrade.com');  
       }
    }
 

}