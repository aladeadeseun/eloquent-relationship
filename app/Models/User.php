<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    function roles(): BelongsToMany{
        return $this->belongsToMany(Role::class, "user_roles", "user_id", "role_id", "id", "id");
        //By default, only the model keys will be present on the pivot model. If your 
        //intermediate table contains extra attributes, you must specify them when defining the relationship:
        //return $this->belongsToMany(Role::class)->withPivot('active', 'created_by');

        /**
         * If you would like your intermediate table to have created_at and updated_at timestamps that are 
         * automatically maintained by Eloquent, call the withTimestamps method when defining the relationship:
         */
        //return $this->belongsToMany(Role::class)->withTimestamps();

        /**
         * If this is the case, you may wish to rename your intermediate table attribute to 
         * subscription instead of pivot. This can be done using the as method when defining the relationship:
         */
        //return $this->belongsToMany(Podcast::class)->as('subscription')->withTimestamps();

        //Filtering Queries via Intermediate Table Columns
        /**
         * return $this->belongsToMany(Role::class)->wherePivot('approved', 1);
         * 
         * return $this->belongsToMany(Role::class)->wherePivotIn('priority', [1, 2]);
         * 
         * return $this->belongsToMany(Role::class)->wherePivotNotIn('priority', [1, 2]);
         * 
         * return $this->belongsToMany(Podcast::class)->as('subscriptions')->wherePivotBetween('created_at', ['2020-01-01 00:00:00', '2020-12-31 00:00:00']);
         * 
         * return $this->belongsToMany(Podcast::class)->as('subscriptions')->wherePivotNotBetween('created_at', ['2020-01-01 00:00:00', '2020-12-31 00:00:00']);
         * 
         * return $this->belongsToMany(Podcast::class)->as('subscriptions')->wherePivotNull('expired_at');
         * 
         * return $this->belongsToMany(Podcast::class)->as('subscriptions')->wherePivotNotNull('expired_at');
         */

        /**
         * If you need to both query and create relationships with a particular pivot value, you may use the withPivotValue method:
         * 
         * return $this->belongsToMany(Role::class)->withPivotValue('approved', 1);
         */
    }
}
