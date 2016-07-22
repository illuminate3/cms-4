<?php

namespace App\Http\Controllers;

use League\Fractal\Resource\{
    Item,
    Collection
};

use Validator;
use App\Models\Terms;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Data\Transformers\Terms as TermsTransformer;

class TermsController extends Controller
{
    /**
     * TermsController constructor
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
        return view('terms.create');
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

        Terms::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'type' => $request->get('type')
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
        $terms = Terms::findOrFail($id);
        
        return view('terms.edit')
            ->with('id', $id);
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

        Terms::find($id)
            ->update([
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
     * @return \Illuminate\Validation\Validator
     */
    private function getValidator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'active' => 'integer|in:0,1',
            'name' => 'required|max:75',
            'description' => 'required|max:200',
            'type' => 'required'
        ]);
    }
}
