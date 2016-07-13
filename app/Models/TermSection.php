<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermSection extends Model
{
    /**
     * Define the models fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'description', 'content'
    ];
}
