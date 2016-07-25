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
     * CampaignController constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['find']
        ]);
    }

    /**
     * Return a listing of all campaigns
     *
     * @return mixed
     */
    public function all()
    {
        $campaigns = Campaign::all();

        return view('campaign.all')
            ->with('campaigns', $campaigns);
    }

    /**
     * Display a campaigns dashboard
     *
     * @param integer $script
     * @return Illuminate\View\View
     */
    public function show($script)
    {
        $campaign = Campaign::where('script', $script)
            ->firstOrFail();

        return view('campaign.view')
            ->with('script', $script);
    }

    /**
     * Find a specific campaign
     *
     * @param integer $script
     * @return mixed
     */
    public function find($script)
    {
        $campaign = Campaign::where('script', $script)
            ->firstOrFail();

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
        $validator = $this->getValidator($request->all());

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
    private function getValidator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'active' => 'required|integer|in:0,1',
            'name' => 'required|max:60',
            'script' => 'required|integer'
        ]);
    }
}
