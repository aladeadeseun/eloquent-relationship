<?php

namespace App\Models;

use Database\Factories\ApplicationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

    protected static function factory()
    {
        return ApplicationFactory::new();
    }

    function deployments(): HasManyThrough{
        //return $this->through("environments")->has("deployments");
        return $this->throughEnvironments()->hasDeployments();
        // return $this->hasManyThrough(
        //     /**
        //      * The first argument passed to the hasManyThrough method is the name of the final model we wish to access, 
        //      * while the second argument is the name of the intermediate model.
        //      */
        //     Deployment::class, 
        //     Environment::class,
        //     "application_id", //Foreign key on the environments table... 
        //     "environment_id", // Foreign key on the deployments table...
        //     "id", // Local key on the applications table...
        //     "id" // Local key on the environments table...
        // );
    }

    function environments(): HasMany{
        return $this->hasMany(Environment::class, "application_id", "id");
    }
}
