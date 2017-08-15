<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');    
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),$this->rules());
        
        if($validator->passes()) {
            $user = User::create([
                'name' => request('name'),
                'email'=> request('email'),
                'password' => bcrypt(request('password'))
            ]);

            //sessin()->flash('message', 'Thanks so much for Siging up!');
            // return redirect()->home();
            return response()->json(['status' => 'Success']); 
        }else {
            return response()->json(['errors' => $validator->errors()->all()]);
        } 
        
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ];
    }
}
