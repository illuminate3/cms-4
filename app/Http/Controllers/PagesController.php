<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Rebuttal,
    Promo,
    Campaign,
    Announcement
};

class PagesController extends Controller
{
    /**
     * Display the users dashboard
     *
     * @return Illuminate\View\View
     */
    public function dashboard(): \Illuminate\View\View
    {
        return view('pages.dashboard');
    }
}
