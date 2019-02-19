<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

<<<<<<< HEAD:app/User.php
/**
 * Undocumented variable
 *
 * @var string
 */
    protected $table = 'users';
=======
>>>>>>> 64b232d640009a39afb356b33f192c8093826bff:app/Models/User.php
    protected $fillable = [
        'id',
        'email',
        'first_name',
        'is_admin',
        'last_name',
        'name',
    ];

  
    
    /**
     * Undocumented variable
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relations
     *
     */

    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }

    public function star()
    {
        return $this->belongsTo('App\Models\Star');
    }

    public function event()
    {
        return $this->belongsToMany('App\Models\Event', 'event_user')
            ->withPivot('user_id');
    }

}
