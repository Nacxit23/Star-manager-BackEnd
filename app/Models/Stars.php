<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stars extends Model
{
    protected $table = 'stars';
    protected $fillable = [
        'id',
        'user_id',
        'paid_at',
    ];
}
