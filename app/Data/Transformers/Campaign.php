<?php

namespace App\Data\Transformers;

use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use App\Data\Transformers\Tab as TabTransformer;
use App\Data\Transformers\Promo as PromoTransformer;
use App\Data\Transformers\Rebuttal as RebuttalTransformer;

class Campaign extends TransformerAbstract
{
    /**
     * Campaign transformer
     *
     * @param App\Models\Campaign $campaign
     * @return array
     */
    public function transform(\App\Models\Campaign $campaign): array
    {
        $rebuttals = (new Manager)->createData(
            new Collection($campaign->rebuttals()->get(), new RebuttalTransformer)
        )->toArray();

        $promos = (new Manager)->createData(
            new Collection($campaign->promos()->get(), new PromoTransformer)
        )->toArray();

        return [
            'id' => $campaign->id,
            'script' => $campaign->script,
            'name' => $campaign->name,
            'rebuttals' => $rebuttals,
            'promos' => $promos,
            'timestamp' => $campaign->created_at->diffForHumans()
        ];
    }
}