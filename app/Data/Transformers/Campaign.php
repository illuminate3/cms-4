<?php

namespace App\Data\Transformers;

use App\Models\Campaign;
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
    public function transform(Campaign $campaign): array
    {
        $tabs = (new Manager)->createData(
            new Collection($campaign->tabs()->get(), new TabTransformer)
        )->toArray();

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
            'tabs' => $tabs,
            'timestamp' => $campaign->created_at->diffForHumans()
        ];
    }
}