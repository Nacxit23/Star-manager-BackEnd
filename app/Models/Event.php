<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'id',
        'star_id',
        'date',
        'name',
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
        return $this->HasMany('App\Models\Star');
    }

    public function user()
    {
        return $this->belongsToMany('App\Models\User', 'event_user')
            ->withPivot('event_id');
    }
}
