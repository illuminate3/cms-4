<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a resource to login
     *
     * @return Illuminate\View\View
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Validate an incoming login request
     *
     * @param Illuminate\Http\Request $request
     * @return mixed
     */
    public function check(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(false);
        }

        $check = Auth::attempt([
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ], false);

        return response()
            ->json($check);
    }
}
