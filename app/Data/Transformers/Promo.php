<?php

namespace App\Data\Transformers;

use League\Fractal\TransformerAbstract;

class Promo extends TransformerAbstract
{
    /**
     * Promotions transformer
     *
     * @param App\Models\Promo $promo
     * @return array
     */
    public function transform(\App\Models\Promo $promo): array
    {
        return [
            'id' => $promo->id,
            'campaign' => $promo->campaign,
            'campaignName' => $promo->campaign()->first()->name,
            'active' => $promo->active,
            'name' => $promo->name,
            'body' => $promo->body,
            'created' => $promo->created_at->diffForHumans(),
            'updated' => $promo->updated_at->diffForHumans()
        ];
    }
}