<?php

namespace App\Http\Controllers;

use League\Fractal\Resource\{
    Item,
    Collection
};

use Validator;
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
     * Display a campaigns dashboard
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

    /**
     * Display a resource to create a campaign
     *
     * @return Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('campaign.create');
    }

    /**
     * Validate and store a newly created campaign
     *
     * @param Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = $this->validateCampaign($request->all());

        if ($validator->fails()) {
            return response()
                ->json($validator->errors());
        }

        Campaign::create([
            'active' => $request->get('active'),
            'script' => intval($request->get('script')),
            'name' => strtolower($request->get('name'))
        ]);

        return response()
            ->json(true);
    }

    /**
     * Validate a newly created campaign
     *
     * @param array $data
     * @return Illuminate\Validation\Validator
     */
    private function validateCampaign(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'active' => 'required|integer|in:0,1',
            'name' => 'required|max:60',
            'script' => 'required|integer'
        ]);
    }
}
