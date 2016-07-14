<?php

namespace App\Http\Controllers;

use League\Fractal\Resource\{
    Item,
    Collection
};

use Validator;
use App\Models\Tab;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Data\Transformers\Tab as TabTransformer;

class TabsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabs = Tab::all();

        return (new Manager)->createData(
            new Collection($tabs, new TabTransformer)
        )->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tabs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->isValidTab($request->all());

        if ($validator->fails()) {
            return response()
                ->json($validator->errors());
        }

        Tab::create([
            'active' => $request->get('active'),
            'popup' => $request->get('popup'),
            'campaign' => $request->get('campaign'),
            'name' => strtolower($request->get('name'))
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Validate a created/updated tab
     *
     * @param array $data
     * @return Illuminate\Validation\Validator
     */
    private function isValidTab(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'active' => 'required|integer|in:0,1',
            'campaign' => 'required|integer|exists:campaigns,id',
            'popup' => 'required|integer|in:0,1',
            'order' => 'integer',
            'name' => 'required|max:100'
        ]);
    }
}
