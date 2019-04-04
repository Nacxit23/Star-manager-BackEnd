<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'event_id',
        'paid_at',
        'user_id',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
