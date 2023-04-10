<?php

namespace wivalidator;
use App\Http\Requests\Request;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Encryption\Encrypter;

class Validator
{
    public function __construct()
    {
    
       $host = request()->root();
       $Host =$this->getDomain($host);
        if(!file_exists(base_path().'/authkey.txt')){
            throw new CE('license key not found');  
        }
        $file = fopen(base_path().'/authkey.txt', "r");
        $key = fgets($file);
        fclose($file);
        if($key){
           try{
            $newEncrypter = new \Illuminate\Encryption\Encrypter( "LhB1GfVL2VLwqn8wAwFbCRXYlB682NGM", 'AES-256-CBC' );
            $decrypted = $newEncrypter->decrypt($key);
            //echo $decrypted = $newEncrypter->encrypt('clicktrade.biz');
          // die();
            if($Host != $decrypted){
                throw new CE('This application is licensed only for '.$decrypted);  
            }

           }catch(Exception $e){
                throw new CE('license key not valid.');  
           }
        }
        else{
            throw new CE('license key not found.');  
        }
        
    }
    function getDomain($url) {
        $host = parse_url($url, PHP_URL_HOST);
    
        if(filter_var($host,FILTER_VALIDATE_IP)) {
            // IP address returned as domain
            return $host; //* or replace with null if you don't want an IP back
        }
    
        $domain_array = explode(".", str_replace('www.', '', $host));
        $count = count($domain_array);
        if( $count>=3 && strlen($domain_array[$count-2])==2 ) {
            // SLD (example.co.uk)
            return implode('.', array_splice($domain_array, $count-3,3));
        } else if( $count>=2 ) {
            // TLD (example.com)
            return implode('.', array_splice($domain_array, $count-2,2));
        }
    }
}