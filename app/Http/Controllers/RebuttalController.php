<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\{
    Campaign,
    Rebuttal
};

use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Collection;
use App\Data\Transformers\Rebuttal as RebuttalTransformer;

class RebuttalController extends Controller
{
    /**
     * Return a full response of rebuttals
     *
     * @return mixed
     */
    public function all()
    {
        $rebuttals = Rebuttal::all();

        return (new Manager)->createData(
            new Collection($rebuttals, new RebuttalTransformer)
        )->toJson();
    }

    /**
     * Find rebuttals for a given campaign
     *
     * @param integer $campaign
     * @return mixed
     */
    public function campaign($campaign)
    {
        $rebuttals = Rebuttal::where('campaign', $campaign)
            ->orderBy('updated_at', 'desc')
            ->get();

        return (new Manager)->createData(
            new Collection($rebuttals, new RebuttalTransformer)
        )->toJson();
    }

    /**
     * Display a resource to edit a rebuttal
     *
     * @param integer $rebuttal
     * @return Illuminate\Views\View
     */
    public function edit($rebuttal): \Illuminate\View\View
    {
        $rebuttal = Rebuttal::findOrFail($rebuttal);
        $campaigns = Campaign::all();

        return view('rebuttals.edit')
            ->with('rebuttal', $rebuttal)
            ->with('campaigns', $campaigns);
    }

    /**
     * Update the edited rebuttal
     *
     * @param Illuminate\Http\Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
        $validator = $this->isValidRebuttal($request->all());

        if ($validator->fails())
        {
            return redirect()
                ->back()
                ->with('errors', $validator->errors()->all());
        }

        $rebuttal = Rebuttal::findOrFail($id)->update([
            'name' => strtolower($request->get('name')),
            'body' => $request->get('body'),
            'active' => $request->get('active'),
            'campaign' => $request->get('campaign')
        ]);

        $request->session()
            ->flash('success', 'Your rebuttal has been successfully updated.');

        return redirect()
            ->route('dashboard');
    }

    /**
     * Display a resource to create a new rebuttal
     *
     * @return Illuminate\View\View
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
     * @param Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = $this->isValidRebuttal($request->all());

        if ($validator->fails())
        {
            return redirect()
                ->back()
                ->with('errors', $validator->errors()->all());
        }

        Rebuttal::create([
            'name' => strtolower($request->get('name')),
            'body' => strtolower($request->get('body')),
            'active' => $request->get('active'),
            'campaign' => $request->get('campaign')
        ]);

        $request->session()->flash('success', 'Rebuttal successfully added');

        return redirect()
            ->route('dashboard');
    }

    /**
     * Delete a rebuttal
     *
     * @param integer $id
     * @return mixed
     */
    public function destroy($id)
    {
        if (! $request->ajax()) {
            abort(404);
        }

        $rebuttal = Rebuttal::findOrFail($id)
            ->destroy();
    }

    /**
     * Check to see if a rebuttal is valid
     *
     * @param array $data
     * @return Illuminate\Validation\Factory
     */
    private function isValidRebuttal(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'name' => 'required|max:60',
            'body' => 'required',
            'campaign' => 'required|integer|exists:campaigns,id',
            'active' => 'required|integer|in:0,1'
        ]);
    }
}
