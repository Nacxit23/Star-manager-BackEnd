<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'api_token',
        'email',
        'first_name',
        'is_admin',
        'last_name',
        'password',
    ];

    /**
     * {@inheritdoc}
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stars()
    {
        return $this->hasMany(Star::class);
    }

    public function scopePaidStar($query)
    {
        return $query->whereHas('stars', function ($query) {
            $query->whereNotNull('paid_at');
        });
    }

    public function scopeNoPaidStar($query)
    {
        return $query->whereHas('stars', function ($query) {
            $query->whereNull('paid_at');
        });
    }
}
