<?php

namespace App\Http\Controllers;

use App\Models\{
    Campaign,
    Rebuttal,
    Promo,
    Terms
};

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display the users dashboard
     *
     * @return Illuminate\View\View
     */
    public function dashboard(): \Illuminate\View\View
    {
        $campaigns = Campaign::orderBy('updated_at', 'desc')
            ->take(5);

        $rebuttals = Rebuttal::orderBy('updated_at', 'desc')
            ->take(5);

        $promos = Promo::orderBy('updated_at', 'desc')
            ->take(5);

        $terms = Terms::all();

        return view('pages.dashboard')
            ->with('campaigns', $campaigns)
            ->with('rebuttals', $rebuttals)
            ->with('promos', $promos)
            ->with('terms', $terms);
    }
}
