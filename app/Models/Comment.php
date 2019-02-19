<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'id',
        'event_id',
        'user_id',
        'description',
    ];

    public function event()
    {
        return $this->HasMany('App\Models\Event');
    }

    public function user()
    {
        return $this->HasMany('App\Models\Comment');
    }
}
