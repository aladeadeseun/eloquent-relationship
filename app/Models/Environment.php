<?php

namespace App\Models;

use Database\Factories\EnvironmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Environment extends Model
{
    protected static function factory()
    {
        return EnvironmentFactory::new();
    }

    /** @use HasFactory<\Database\Factories\EnvironmentFactory> */
    use HasFactory;

    function deployments(): HasMany{
        return $this->hasMany(Deployment::class, "environment_id", "id");
    }

    function application(): BelongsTo{
        return $this->belongsTo(Application::class, "application_id", "id");
    }
}
