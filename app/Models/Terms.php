<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    /**
     * Define the fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'active', 'name', 'description', 'type', 'pattern'
    ];
}
