<?php

namespace App\Http\Controllers;

use App\Models\{
    Section,
    Terms
};

use Validator;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use App\Data\Transformers\Section as SectionTransformer;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();

        return (new Manager)->createData(
            new Collection($sections, new SectionTransformer)
        )->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::findOrFail($id);

        return (new Manager)->createData(
            new Item($section, new SectionTransformer)
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
        $section = Section::findOrFail($id);

        $terms = Terms::where('pattern', 'like', '%' . $section->id . '%')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('sections.edit')
            ->with('id', $id)
            ->with('terms', $terms);
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

        $section = Section::findOrFail($id)->update([
            'name' => strtolower($request->get('name')),
            'content' => $request->get('content'),
            'description' => $request->get('description')
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
        //
    }

    /**
     * Make sure a section has valid data
     *
     * @param  array  $data
     * @return \Illuminate\Validation\Validator
     */
    private function getValidator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'name' => 'required|max:75',
            'description' => 'required|max:200',
            'content' => 'required'
        ]);
    }
}
