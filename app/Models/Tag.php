<?php

namespace App\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected static function factory()
    {
        return TagFactory::new();
    }

    function posts(): MorphToMany{
        return $this->morphedByMany(
            Post::class,
            "taggable",
            "taggables",
            "taggable_id", 
            "tag_id", "id", "id"
        );
    }

    function videos():MorphToMany{
        return $this->morphedByMany(
            Video::class,
            "taggable",
            "taggables",
            "taggable_id", 
            "tag_id", "id", "id"
        );
    }
}
