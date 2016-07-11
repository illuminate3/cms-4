<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use App\Data\Transformers\Promo as PromoTransformer;

class PromoController extends Controller
{
    /**
     * Return a full response of promos
     *
     * @return mixed
     */
    public function all()
    {
        $promos = Promo::all();

        return (new Manager)->createData(
            new Collection($promos, new PromoTransformer)
        )->toJson();
    }

    /**
     * Find promos for a given campaign
     *
     * @param integer $campaign
     * @return mixed
     */
    public function campaign($campaign)
    {
        $promos = Promo::where('campaign', $campaign)
            ->orderBy('updated_at', 'desc')
            ->get();

        return (new Manager)->createData(
            new Collection($promos, new PromoTransformer)
        )->toJson();
    }
}
