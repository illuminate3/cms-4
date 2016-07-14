<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * Sections fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'content'
    ];
}
