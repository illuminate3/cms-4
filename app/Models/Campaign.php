<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    /**
     * HasMany relationship to return a campaign announcements
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Promo', 'campaign', 'id');
    }

    /**
     * HasMany relationship to return a campaign announcements
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rebuttals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Rebuttal', 'campaign', 'id');
    }

    /**
     * HasMany relationship to return a campaign announcements
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function announcements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Announcement', 'campaign', 'id');
    }
}
