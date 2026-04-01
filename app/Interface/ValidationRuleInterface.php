<?php

namespace App\Interface;

interface ValidationRuleInterface{
    function getValidator(): ValidatorInterface;
}