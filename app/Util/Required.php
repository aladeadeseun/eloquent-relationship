<?php

namespace App\Util;

use App\Interface\ValidationRuleInterface;
use App\Interface\ValidatorInterface;
use Attribute;

#[Attribute]
class Required implements ValidationRuleInterface{

    public function getValidator(): ValidatorInterface
    {
        return new RequiredValidator();
    }

}