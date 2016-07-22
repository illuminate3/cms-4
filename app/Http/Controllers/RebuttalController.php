<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\{
    Campaign,
    Rebuttal
};

use League\Fractal\Resource\{
    Collection,
    Item
};

use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Data\Transformers\Rebuttal as RebuttalTransformer;

class RebuttalController extends Controller
{
    /**
     * RebuttalController constructor
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
     * Return a full response of rebuttals
     *
     * @return mixed
     */
    public function index()
    {
        $rebuttals = Rebuttal::simplePaginate(20);

        return view('rebuttals.all')
            ->with('rebuttals', $rebuttals);
    }

    /**
     * Find a specific rebuttal
     *
     * @param integer $id
     * @return mixed
     */
    public function show($id)
    {
        $rebuttal = Rebuttal::findOrFail($id);

        return (new Manager)->createData(
            new Item($rebuttal, new RebuttalTransformer)
        )->toJson();
    }

    /**
     * Display a resource to edit a rebuttal
     *
     * @param integer $id
     * @return \Illuminate\Views\View
     */
    public function edit($id): \Illuminate\View\View
    {
        $rebuttal = Rebuttal::findOrFail($id);

        return view('rebuttals.edit')
            ->with('id', $id);
    }

    /**
     * Update the edited rebuttal
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

        $rebuttal = Rebuttal::findOrFail($id)
            ->update([
                'name' => strtolower($request->get('name')),
                'body' => $request->get('body'),
                'active' => $request->get('active'),
                'campaign' => $request->get('campaign')
            ]);

        return response()
            ->json(true);
    }

    /**
     * Display a resource to create a new rebuttal
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        $campaigns = Campaign::all();

        return view('rebuttals.new')
            ->with('campaigns', $campaigns);
    }

    /**
     * Store the newly created rebuttal
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

        Rebuttal::create([
            'name' => strtolower($request->get('name')),
            'body' => strtolower($request->get('body')),
            'active' => $request->get('active'),
            'campaign' => $request->get('campaign')
        ]);

        return response()
            ->json(true);
    }

    /**
     * Delete a rebuttal
     *
     * @param integer $id
     * @return mixed
     */
    public function destroy($id)
    {
        $rebuttal = Rebuttal::findOrFail($id)
            ->destroy($id);

        return response()
            ->json(true);
    }

    /**
     * Check to see if a rebuttal is valid
     *
     * @param array $data
     * @return \Illuminate\Validation\Factory
     */
    private function getValidator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'name' => 'required|max:60',
            'body' => 'required',
            'campaign' => 'required|integer|exists:campaigns,id',
            'active' => 'required|integer|in:0,1'
        ]);
    }
}
