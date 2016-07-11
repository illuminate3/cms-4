<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rebuttal extends Model
{
    /**
     * Define the fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'name', 'body', 'active', 'campaign'
    ];

    /**
     * BelongsTo relationship
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Campaign', 'campaign', 'id');
    }
}
