<?php

namespace App\Data\Transformers;

use App\Models\Tab;
use League\Fractal\TransformerAbstract;

class Tab extends TransformerAbstract
{
    /**
     * Return a formatted array of tabs
     *
     * @param App\Models\Tab $tab
     * @return array
     */
    public function transform(Tab $tab): array
    {
        return [
            'id' => $tab->id,
            'order' => $tab->order,
            'active' => $tab->active,
            'popup' => $tab->popup,
            'campaign' => $tab->campaign()->first()->name,
            'name' => $tab->name,
            'created' => $tab->created_at->diffForHumans(),
            'updated' => $tab->updated_at->diffForHumans()
        ];
    }
}