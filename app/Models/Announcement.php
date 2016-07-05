<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    /**
     * HasOne relationship to return the user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\User', 'id', 'user');
    }
}
