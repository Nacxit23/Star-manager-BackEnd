<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{

    protected $fillable = [
        'id',
        'user_id',
        'paid_at',
    ];

    /**
     * Relations
     *
     */

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
