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
<<<<<<< HEAD

<<<<<<< HEAD:app/User.php
/**
 * Undocumented variable
 *
 * @var string
 */
    protected $table = 'users';
=======
>>>>>>> 64b232d640009a39afb356b33f192c8093826bff:app/Models/User.php
=======
>>>>>>> e0d2372f1175aae97e9d81ab02c5b08ac892a6e0
    protected $fillable = [
        'email',
        'first_name',
        'is_admin',
        'last_name',
    ];

  
    
    /**
<<<<<<< HEAD
     * Undocumented variable
     *
     * @var array
=======
     * {@inheritdoc}
>>>>>>> e0d2372f1175aae97e9d81ab02c5b08ac892a6e0
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
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
}
