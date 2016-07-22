<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of all users
     *
     * @return \Illuminate\View\Vieww
     */
    public function index(): \Illuminate\View\View
    {
        $users = User::all();

        return view('auth.all')
            ->with('users', $users);
    }

    /**
     * Display a resource to create a new user
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('auth.create');
    }

    /** 
     * Validate and register a new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = $this->getValidator($request->all());

        if ($validator->fails()) {
            return response()
                ->json($validator->errors());;
        }

        $request->user()->create([
            'name' => strtolower($request->get('name')),
            'username' => strtolower($request->get('username')),
            'email' => strtolower($request->get('email')),
            'biography' => strtolower($request->get('position')),
            'password' => bcrypt($request->get('password')),
            'admin' => $request->get('admin')
        ]);

        return response()
            ->json(true);
    }

    /**
     * Display a resource to login
     *
     * @return Illuminate\View\View
     */
    public function login(): \Illuminate\View\View
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
        ]);

        return response()
            ->json($check);
    }

    /**
     * Log a user out of the application
     *
     * @return mixed
     */
    public function destroy()
    {
        Auth::logout();

        return redirect()
            ->route('login');
    }

    /**
     * Validate a user
     *
     * @param  array  $data
     * @return \Illuminate\Validation\Validator
     */
    private function getValidator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'admin' => 'required|integer|in:0,1',
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username|max:30',
            'email' => 'required|max:100|unique:users,email',
            'password' => 'required|max:30',
            'position' => 'required|max:60'
        ]);
    }
}
