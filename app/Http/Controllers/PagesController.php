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
        return view('pages.dashboard')
            ->with('campaigns', Campaign::all())
            ->with('rebuttals', Rebuttal::all())
            ->with('promos', Promo::all())
            ->with('terms', Terms::all());
    }
}
