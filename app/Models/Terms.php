<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    /**
     * Define the models fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'active', 'pattern', 'plan_type', 'description'
    ];
}
