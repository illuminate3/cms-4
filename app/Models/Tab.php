<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
    /**
     * Define the tabs fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'campaign', 'order', 'active', 'popup', 'name'
    ];

    /**
     * A tab belongs to a campaign
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Campaign', 'campaign', 'id');
    }
}
