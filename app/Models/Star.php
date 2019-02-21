<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'user_id',
        'paid_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function events()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
