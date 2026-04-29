<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable(['title','author_id', 'body', 'created_at', 'updated_at'])]
class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected static function factory()
    {
        return PostFactory::new();
    }

    function comments(): HasMany{
        return $this->hasMany(Comment::class, "post_id", "id");
    }

    function author(): BelongsTo{
        return $this->belongsTo(User::class, "author_id", "id");
    }

    /**
     * Get the post's image.
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable', "imageable_type", "imageable_id");
    }

    public function polymorphicComments(): MorphMany{
        return $this->morphMany(
            PolymorphicComment::class, "commentable", "commentable_type", "commentable_id", "id"
        );
    }

    /**
     * Get the user's most recent image.
     */
    public function latestComment(): MorphOne
    {
        return $this->morphOne(PolymorphicComment::class, 'commentable', 'commentable_type', "commentable_id")->latestOfMany();
    }

    public function oldestComment(): MorphOne
    {
        return $this->morphOne(PolymorphicComment::class, 'commentable', 'commentable_type', "commentable_id", "id")->oldestOfMany();
    }

    /**
     * Get the user's most popular comment.
     */
    public function bestComment(): MorphOne
    {
        return $this->morphOne(PolymorphicComment::class, 'commentable', "commentable_type", "commentable_id", "id")->ofMany('likes', 'max');
    }

    public function tags(): MorphToMany{
        return $this->morphToMany(
            Tag::class, 
            "taggable",    // $name
            'taggables',   // $table
            'taggable_id', // $foreignPivotKey (Corrected: Links to Post/Video ID)
            'tag_id',      // $relatedPivotKey (Corrected: Links to Tag ID)
            'id',          // $parentKey
            'id'           // $relatedKey
        );
    }
}
