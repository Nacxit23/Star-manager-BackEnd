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

    protected $fillable = [
        'id',
        'email',
        'first_name',
        'is_admin',
        'last_name',
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
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
