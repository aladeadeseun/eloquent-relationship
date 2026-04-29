<?php

namespace App\Models;

use Database\Factories\VideoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;

    protected static function factory()
    {
        return VideoFactory::new();
    }

    public function polymorphicComments(): MorphMany{
        return $this->morphMany(PolymorphicComment::class, "commentable", "commentable_type", "commentable_id", "id");
    }

    /**
     * Get the user's most recent image.
     */
    public function latestComment(): MorphOne
    {
        return $this->morphOne(PolymorphicComment::class, 'commentable', 'commentable_type', "commentable_id", "id")->latestOfMany();
    }

    public function tags(): MorphToMany
    {
        /***
         * 1. $related
         * •	What it is: The class name of the model you want to retrieve.
         * •	Your case: Post::class or Video::class.
         * •	Purpose: Tells Laravel what kind of objects to return when you call the relationship.
         * 
         * 2. $name
         * •	What it is: The "morph name" you assigned to the relationship.
         * •	Your case: 'commentable'.
         * •	Purpose: Laravel uses this to guess the column names in the pivot table by appending _id and _type (resulting in commentable_id and commentable_type).
         * 
         * 3. $table
         * •	What it is: The name of the pivot table.
         * •	Default: Laravel pluralizes the $name (e.g., commentables).
         * •	Purpose: If you named your pivot table something non-standard (like links or attachments), you define it here.
         * 
         * 4. $foreignPivotKey
         * •	What it is: The column in the pivot table that refers to the current model (the Comment).
         * •	Default: polymorphic_comment_id (derived from the model name).
         * •	Purpose: This is how Laravel knows which rows in the pivot table belong to the specific comment you are looking at.
         * 
         * 5. $relatedPivotKey
         * •	What it is: The column in the pivot table that refers to the target model (the Post/Video).
         * •	Default: commentable_id (derived from the $name parameter).
         * •	Purpose: Once Laravel finds the comment's rows, it uses this key to find the IDs of the Posts or Videos.
         * 
         * 6. $parentKey
         * •	What it is: The primary key of the current model (the Comment).
         * •	Default: id.
         * •	Purpose: The value Laravel pulls from your comment to compare against the $foreignPivotKey.
         * 
         * 7. $relatedKey
         * •	What it is: The primary key of the target model (the Post/Video).
         * •	Default: id.
         * •	Purpose: The value Laravel pulls from the Post/Video table to compare against the $relatedPivotKey.
         * 
         * 8. $relation
         * •	What it is: The name of the relationship method itself.
         * •	Default: The name of the function you are currently writing (e.g., posts).
         * •	Purpose: Useful if you are defining the relationship dynamically or via a different method name than usual.
Visualization of the Parameter F
         */
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
