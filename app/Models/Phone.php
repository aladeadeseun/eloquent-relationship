<?php

namespace App\Models;

use Database\Factories\PhoneFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    //
    protected static function newFactory()
    {
        return PhoneFactory::new();
    }
}
