<?php

namespace App\Util;

use App\Interface\ValidatorInterface;

class RequiredValidator implements ValidatorInterface{
    function validate($value): bool
    {
        return !empty($value);
    }
}