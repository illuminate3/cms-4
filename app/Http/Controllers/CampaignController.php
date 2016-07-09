<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Collection;
use App\Data\Transformers\Campaign as CampaignTransformer;

class CampaignController extends Controller
{
    /**
     * Return a listing of all campaigns
     *
     * @return mixed
     */
    public function index()
    {
        $campaigns = Campaign::all();

        return (new Manager)->createData(
            new Collection($campaigns, new CampaignTransformer)
        )->toJson();
    }

    /**
     * Display a resource to create a campaign
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
    }

    /**
     * Accept an http request to create a campaign
     *
     * @param Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
    }

    /**
     * Return a listing of a specific campaign
     *
     * @param integer $id
     * @return Illuminate\View\View
     */
    public function find($id)
    {
    }

    /**
     * Accept an http request to delete a campaign
     *
     * @param Illuminate\Http\Request $request
     * @return mixed
     */
    public function destroy(Request $request)
    {
    }
}
