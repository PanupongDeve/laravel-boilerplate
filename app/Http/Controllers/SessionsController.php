<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',['except' => 'destroy']);
    }
    public function create()
    {
        return view('sessions.create');
    }

    public function destroy()
    {
        auth()->logout();
        //return redirect()->home();
        return response()->json(['status' => 'Logout Success']);
    }

    public function store()
    {
        if(! auth()->attempt(request(['email','password']))){
            /*
            return back()->withErrors([
                'message' => 'Plesease check you credentials and try again.'
            ]);*/
            return response()->json(['status' => 'Login Fails']);
        }

        return response()->json(['status' => 'Login Success ']);
        //return redirect()->home();
    }
}
