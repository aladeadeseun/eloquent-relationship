<?php

namespace App\Util;

readonly class RegisterUser{
    function __construct(
        #[Required]
        public string $email, 
        #[Required]
        public string $username
    ){
        //throw new \Exception('Not implemented');
    }
}