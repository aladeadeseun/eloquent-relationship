<?php

namespace App\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    protected static function factory()
    {
        return RoleFactory::new();
    }

    function users(): BelongsToMany{
        return $this->belongsToMany(User::class, "user_roles", "role_id", "user_id", "id", "id");
    }
}
