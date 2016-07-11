<?php

namespace App\Http\Controllers;

use App\Models\Rebuttal;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use App\Data\Transformers\Rebuttal as RebuttalTransformer;

class RebuttalController extends Controller
{
    /**
     * Return a full response of rebuttals
     *
     * @return mixed
     */
    public function all()
    {
        $rebuttals = Rebuttal::all();

        return (new Manager)->createData(
            new Collection($rebuttals, new RebuttalTransformer)
        )->toJson();
    }

    /**
     * Find rebuttals for a given campaign
     *
     * @param integer $campaign
     * @return mixed
     */
    public function campaign($campaign)
    {
        $rebuttals = Rebuttal::where('campaign', $campaign)
            ->orderBy('updated_at', 'desc')
            ->get();

        return (new Manager)->createData(
            new Collection($rebuttals, new RebuttalTransformer)
        )->toJson();
    }
}
