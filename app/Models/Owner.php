<?php

namespace App\Models;

use Database\Factories\OwnerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{
    /** @use HasFactory<\Database\Factories\OwnerFactory> */
    use HasFactory;

    protected static function factory()
    {
        return OwnerFactory::new();
    }

    function car(): BelongsTo{
        return $this->belongsTo(Car::class, "car_id", "id");
    }
}
