<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    protected $table = 'stars';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'paid_at',
    ];

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
