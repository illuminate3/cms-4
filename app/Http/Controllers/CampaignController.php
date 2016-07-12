<?php

namespace App\Http\Controllers;

use League\Fractal\Resource\{
    Item,
    Collection
};

use App\Models\Campaign;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Data\Transformers\Campaign as CampaignTransformer;

class CampaignController extends Controller
{
    /**
     * Return a listing of all campaigns
     *
     * @return mixed
     */
    public function all()
    {
        $campaigns = Campaign::all();

        return (new Manager)->createData(
            new Collection($campaigns, new CampaignTransformer)
        )->toJson();
    }

    /**
     * Display a resource to create a campaign
     *
     * @param integer $id
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('campaign.view')
            ->with('id', $id);
    }

    /**
     * Find a specific campaign
     *
     * @param integer $id
     * @return mixed
     */
    public function find($id)
    {
        $campaign = Campaign::findOrFail($id);

        return (new Manager)->createData(
            new Item($campaign, new CampaignTransformer)
        )->toJson();
    }
}
