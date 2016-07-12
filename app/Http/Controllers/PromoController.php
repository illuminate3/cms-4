<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\{
    Campaign,
    Promo
};

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

    /**
     * Display a resource to create a new promo
     *
     * @return Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        $campaigns = Campaign::all();

        return view('promos.create')
            ->with('campaigns', $campaigns);
    }

    /**
     * Validate and store a newly created promo
     *
     * @param Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = $this->isValidPromo($request->all());

        if ($validator->fails())
        {
            return redirect()
                ->back()
                ->with('errors', $validator->errors()->all());
        }

        Promo::create([
            'campaign' => $request->get('campaign'),
            'active' => $request->get('active'),
            'name' => strtolower($request->get('name')),
            'body' => strtolower($request->get('body'))
        ]);

        $request->session()->flash('success', 'Promo successfully added');

        return redirect()
            ->route('dashboard');
    }

    /**
     * Display a resource to edit a promo
     *
     * @param integer $id
     * @return Illuminate\View\View
     */
    public function edit($id): \Illuminate\View\View
    {
        $promo = Promo::findOrFail($id);
        $campaigns = Campaign::all();

        return view('promos.edit')
            ->with('promo', $promo)
            ->with('campaigns', $campaigns);
    }

    /**
     * Update a given promo
     *
     * @param integer $id
     * @return mixed
     */
    public function update($id, Request $request)
    {
        $validator = $this->isValidPromo($request->all());

        if ($validator->fails())
        {
            return redirect()
                ->back()
                ->with('errors', $validator->errors()->all());
        }

        $promo = Promo::findOrFail($id);

        $promo->name = strtolower($request->get('name'));
        $promo->body = strtolower($request->get('body'));
        $promo->campaign = $request->get('campaign');
        $promo->active = $request->get('active');

        if (!$promo->save())
        {
            $request->session()->flash('error', 'There was an issue updating your promotion.');

            return redirect()
                ->back();
        }

        $request->session()->flash('success', 'Your promo has been updated.');

        return redirect()
            ->route('dashboard');
    }

    /**
     * Validate a new promotion
     *
     * @param array $data
     * @return Illuminate\Validation\Validator
     */
    private function isValidPromo(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'campaign' => 'integer|required|exists:campaigns,id',
            'name' => 'required|max:60',
            'body' => 'required',
            'active' => 'integer|required|in:0,1'
        ]);
    }
}
