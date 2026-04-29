<?php

namespace App\Models;

use Database\Factories\PolymorphicCommentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable(['commentable_type','commentable_id', 'body', 'created_at', 'updated_at'])]
class PolymorphicComment extends Model
{
    /** @use HasFactory<\Database\Factories\PolymorphicCommentFactory> */
    use HasFactory;

    /**
     * Get the parent commentable model (post or video).
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'commentable_type', 'commentable_id');
    }

    //
    protected static function factory()
    {
        return PolymorphicCommentFactory::new();
    }
}
