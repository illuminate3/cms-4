<?php

namespace App\Http\Controllers;

use League\Fractal\Resource\{
    Item,
    Collection
};

use Validator;
use League\Fractal\Manager;
use App\Models\PlanFeature;
use Illuminate\Http\Request;
use App\Data\Transformers\PlanFeature as PlanFeatureTransformer;

class PlanFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = PlanFeature::orderBy('updated_at', 'desc')
            ->get();

        return (new Manager)->createData(
            new Collection($features, new PlanFeatureTransformer)
        )->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('features.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->getValidator($request->all());

        if ($validator->fails()) {
            return response()
                ->json($validator->errors());
        }

        PlanFeature::create([
            'active' => $request->get('active'),
            'name' => strtolower($request->get('name')),
            'content' => strtolower($request->get('content'))
        ]);

        return response()
            ->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ... show a feature
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature = PlanFeature::findOrFail($id);

        return view('features.edit')
            ->with('feature', $feature);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->getValidator($request->all());

        if ($validator->fails()) {
            return response()
                ->json($validator->errors());
        }

        $feature = PlanFeature::findOrFail($id)->update([
            'active' => $request->get('active'),
            'name' => strtolower($request->get('name')),
            'content' => strtolower($request->get('content'))
        ]);

        return response()
            ->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return response()
                ->json(false);
        }

        $feature = PlanFeature::findOrFail($id)
            ->destroy($id);

        return response()
            ->json(true);
    }

    /**
     * Retrieve a new validation instance
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    private function getValidator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'active' => 'required|in:0,1',
            'name' => 'required|max:100',
            'content' => 'required'
        ]);
    }
}
