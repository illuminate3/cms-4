<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\{
    Campaign,
    Promo
};

use League\Fractal\Resource\{
    Item,
    Collection
};

use Illuminate\Http\Request;
use League\Fractal\Manager;
use App\Data\Transformers\Promo as PromoTransformer;

class PromoController extends Controller
{
    /**
     * PromoController constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index', 'show']
        ]);
    }

    /**
     * Return a full response of promos
     *
     * @return mixed
     */
    public function index()
    {
        $promos = Promo::all();

        return (new Manager)->createData(
            new Collection($promos, new PromoTransformer)
        )->toJson();
    }

    /**
     * Find a specific promo
     *
     * @param integer $id
     * @return mixed
     */
    public function show($id)
    {
        $promo = Promo::findOrFail($id);

        return (new Manager)->createData(
            new Item($promo, new PromoTransformer)
        )->toJson();
    }

    /**
     * Display a resource to create a new promo
     *
     * @return \Illuminate\View\View
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
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = $this->getValidator($request->all());

        if ($validator->fails()) {
            return response()
                ->json($validator->errors());
        }

        Promo::create([
            'campaign' => $request->get('campaign'),
            'active' => $request->get('active'),
            'name' => strtolower($request->get('name')),
            'body' => strtolower($request->get('body'))
        ]);

        return response()
            ->json(true);
    }

    /**
     * Display a resource to edit a promo
     *
     * @param integer $id
     * @return \Illuminate\View\View
     */
    public function edit($id): \Illuminate\View\View
    {
        $promo = Promo::findOrFail($id);

        return view('promos.edit')
            ->with('id', $id);
    }

    /**
     * Update a given promo
     *
     * @param \Illuminate\Http\Request $request
     * @param integer $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $validator = $this->getValidator($request->all());

        if ($validator->fails()) {
            return response()
                ->json($validator->errors());
        }

        $promo = Promo::findOrFail($id)
            ->update([
                'name' => strtolower($request->get('name')),
                'body' => $request->get('body'),
                'campaign' => $request->get('campaign'),
                'active' => $request->get('active')
            ]);

        return response()
            ->json(true);
    }

    /**
     * Delete a given promotion
     *
     * @param integer $id
     * @return mixed
     */
    public function destroy($id)
    {
        $promo = Promo::findOrFail($id)
            ->destroy($id);

        return response()
            ->json(true);
    }

    /**
     * Validate a new promotion
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    private function getValidator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'campaign' => 'integer|required|exists:campaigns,id',
            'name' => 'required|max:60',
            'body' => 'required',
            'active' => 'integer|required|in:0,1'
        ]);
    }
}
