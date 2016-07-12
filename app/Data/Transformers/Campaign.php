<?php

namespace App\Data\Transformers;

use App\Models\Campaign;
use League\Fractal\TransformerAbstract;

class Campaign extends TransformerAbstract
{
    /**
     * Campaign transformer
     *
     * @param App\Models\Campaign $campaign
     * @return array
     */
    public function transform(Campaign $campaign)
    {
        return [
            'id' => $campaign->id,
            'script' => $campaign->script,
            'name' => $campaign->name,
            'rebuttals' => $campaign->rebuttals()->get(),
            'promos' => $campaign->promos()->get(),
            'timestamp' => $campaign->created_at->diffForHumans()
        ];
    }
}