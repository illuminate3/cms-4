<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    /**
     * Holds the fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'campaign', 'active', 'body', 'name'
    ];

    /**
     * BelongsTo relationship promo -> campaign
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Campaign', 'campaign', 'script');
    }
}
