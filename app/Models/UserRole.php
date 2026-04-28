<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

#[Table(incrementing: true)]
class UserRole extends Pivot
{
    public $table = "user_roles";
    /** @use HasFactory<\Database\Factories\UserRoleFactory> */
    use HasFactory;

    function user(): BelongsTo{
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
