<?php

namespace App\Models;

use Database\Factories\DeploymentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deployment extends Model
{
    /** @use HasFactory<\Database\Factories\DeploymentFactory> */
    use HasFactory;

    protected static function factory()
    {
        return DeploymentFactory::new();
    }

    function environment(): BelongsTo{
        return $this->belongsTo(Environment::class, "environment_id", "id");
    }
}
