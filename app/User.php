<?php

namespace App;

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

/**
 * Undocumented variable
 *
 * @var string
 */
    protected $table = 'users';
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
}
