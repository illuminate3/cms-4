<?php

namespace App\Http\Controllers;

use League\Fractal\Resource\{
    Item,
    Collection
};

use App\Models\Terms;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Data\Transformers\Terms as TermsTransformer;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Terms::all();

        return (new Manager)->createData(
            new Collection($terms, new TermsTransformer)
        )->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ... New terms and conditions
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->isValidTerms($request->all());

        if ($validator->fails()) {
            return response()
                ->json($validator->errors());
        }

        Terms::create([
            'active' => $request->get('active'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'type' => $request->get('type'),
            'pattern' => $request->get('pattern')
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
        $terms = Terms::findOrFail($id);

        return (new Manager)->createData(
            new Item($terms, new TermsTransformer)
        )->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ... Form for editing
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
        // ... Save new updates
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terms = Terms::findOrFail($id)
            ->destroy($id);

        return response()
            ->json(true);
    }

    /**
     * Validate an incoming request
     *
     * @param array $data
     * @return Illuminate\Validation\Validator
     */
    private function isValidTerms(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'active' => 'integer|required|in:0,1',
            'name' => 'required|max:75',
            'description' => 'required|max:200',
            'type' => 'required',
            'pattern' => 'required'
        ]);
    }
}
