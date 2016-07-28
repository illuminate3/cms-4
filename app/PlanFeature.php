<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    /**
     * The tables fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'active', 'name', 'content'
    ];
}
