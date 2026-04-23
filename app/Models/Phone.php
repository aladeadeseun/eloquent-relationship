<?php

namespace App\Models;

use Database\Factories\PhoneFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['model', 'created_at', 'phone_number', 'user_id', 'created_at'])]
class Phone extends Model
{
    //
    protected static function factory()
    {
        return PhoneFactory::new();
    }

    function user(): BelongsTo{
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
