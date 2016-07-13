<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Terms;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of all terms and controllers
     *
     * @return mixed
     */
    public function index()
    {
        $terms = Terms::all();

        return (new Manager)->createData(
            new Collection($terms, new TermTransformer)
        )->toJson();
    }

    /**
     * Find a specific terms entry for a given id
     *
     * @param string $type
     * @return mixed
     */
    public function show($type)
    {
        $term = Terms::where('type', $type)
            ->firstOrFail();

        return (new Manager)->createData(
            new Item($term, new TermTransformer)
        )->toJson();
    }

    /**
     * Display a resource to create a new entry
     *
     * @return Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('terms.create');
    }

    /**
     * Validate and store a newly created terms
     *
     * @param Illuminate\Http\Request $request
     * @return mixed
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
            'type' => strtolower($request->get('type')),
            'pattern' => $request->get('pattern'),
            'description' => strtolower($request->get('description'))
        ]);

        return resposne()
            ->json(true);
    }

    /**
     * Display a resource to edit a terms
     *
     * @return Illuminate\View\View
     */
    public function edit($id): \Illuminate\View\View
    {
        $term = Terms::findOrFail($id);

        return view('terms.edit')
            ->with('term', $term);
    }

    /**
     * Save the newly updated terms
     *
     * @param Illuminate\Http\Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
        $validator = $this->isValidTerms($request->all());

        if ($validator->fails()) {
            return resposne()
                ->json($validator->errors());
        }

        $term = Terms::findOrFail($id)->update([
            'active' => $request->get('active'),
            'pattern' => $request->get('pattern'),
            'description' => strtolower($request->get('description')),
            'type' => strtolower($request->get('type'))
        ]);

        return response()
            ->json(true);
    }

    /**
     * Delete an entry
     *
     * @param integer $id
     * @return mixed
     */
    public function destroy($id)
    {
        $term = Term::findOrFail($id)
            ->destroy($id);

        return response()
            ->json(true);
    }

    /**
     * Check to see if an entry is valid
     *
     * @param array $data
     * @return Illuminate\Validation\Validator
     */
    private function isValidTerms(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'active' => 'required|integer|in:0,1',
            'type' => 'required|max:100',
            'pattern' => 'required|max:100',
            'description' => 'required|max:200'
        ]);
    }
}
