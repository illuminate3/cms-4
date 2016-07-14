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
        'active', 'pattern', 'type', 'description'
    ];

    /**
     * HasOne relationship to get a terms type
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\TermType', 'id', 'type');
    }
}
