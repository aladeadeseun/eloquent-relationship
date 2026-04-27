<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    function phone(): HasOne{
        return $this->hasOne(Phone::class, "user_id", "id")->withDefault();
    }

    function posts(): HasMany{
        return $this->hasMany(Post::class, "author_id", "id");
    }

    function comments(): HasMany{
        
        return $this->hasMany(Comment::class, "author_id", "id")->chaperone();
    }

    /**
     * Get the user's most recent post.
     */
    public function latestPost(): HasOne
    {
        return $this->hasOne(Post::class, "author_id", "id")->latestOfMany();
    }

    /**
     * Get the user's most recent comment.
     */
    public function latestComment(): HasOne
    {
        return $this->hasOne(Comment::class, "author_id", "id")->latestOfMany();
    }

    /**
     * Get the user's most recent post.
     */
    public function oldestPost(): HasOne
    {
        return $this->hasOne(Post::class, "author_id", "id")->latestOfMany();
    }

    /**
     * Get the user's most recent comment.
     */
    public function oldestComment(): HasOne
    {
        return $this->hasOne(Comment::class, "author_id", "id")->latestOfMany();
    }
}
