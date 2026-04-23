<?php

namespace App\Models;

use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['post_id', 'body', 'created_at', 'updated_at', 'user_id'])]
class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected static function factory()
    {
        return CommentFactory::new();
    }

    function post(): BelongsTo{
        return $this->belongsTo(Post::class, "post_id", "id");
    }
}
