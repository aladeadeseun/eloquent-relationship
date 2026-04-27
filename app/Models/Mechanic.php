<?php

namespace App\Models;

use Database\Factories\MechanicFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Mechanic extends Model
{
    /** @use HasFactory<\Database\Factories\MechanicFactory> */
    use HasFactory;

    protected static function factory()
    {
        return MechanicFactory::new();
    }

    function car(): HasOne{
        return $this->hasOne(Car::class, "mechanic_id", "id");
    }
    
    function carOwner(): HasOneThrough{
        /**
         * This approach offers the advantage of reusing the key conventions already defined on the existing relationships:
         */
        // String based syntax...
        //return $this->through("car")->has("owner");

        // Dynamic syntax...
        //return $this->throughCar()->hasOwner();

        return $this->hasOneThrough(
            Owner::class, 
            Car::class, 
            "mechanic_id", // Foreign key on the cars table...
            "car_id", // Foreign key on the owners table...
            "id", // Local key on the mechanics table...
            "id" // Local key on the cars table...
        );
    }
}
