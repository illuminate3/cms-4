<?php

namespace App\Data\Transformers;

use App\Models\Rebuttal;
use League\Fractal\TransformerAbstract;

class Rebuttal extends TransformerAbstract
{
    /**
     * Rebuttal transformer
     *
     * @param App\Models\Rebuttal $rebuttal
     * @return array
     */
    public function transform(Rebuttal $rebuttal)
    {
        return [
            'id' => $rebuttal->id,
            'active' => $rebuttal->active,
            'campaign' => $rebuttal->campaign,
            'campaignName' => $rebuttal->campaign()->first()->name,
            'name' => $rebuttal->name,
            'body' => $rebuttal->body,
            'created' => $rebuttal->created_at->diffForHumans(),
            'updated' => $rebuttal->updated_at->diffForHumans()
        ];
    }
}