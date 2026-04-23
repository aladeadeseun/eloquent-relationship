<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['title','user_id', 'body', 'created_at', 'updated_at'])]
class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected static function factory()
    {
        return PostFactory::new();
    }

    function comments(): HasMany{
        return $this->hasMany(Post::class, "post_id", "id");
    }

    function author(): BelongsTo{
        return $this->belongsTo(User::class, "author_id", "id");
    }
}
