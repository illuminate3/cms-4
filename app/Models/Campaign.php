<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    /**
     * Define the fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'script', 'active', 'name'
    ];

    /**
     * HasMany relationship to return tabs for a campaign
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tabs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Tab', 'campaign', 'id');
    }

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
