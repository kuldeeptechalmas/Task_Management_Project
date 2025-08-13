<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\users;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod("post")){

        $validator = Validator::make($request->all(), [
            "email" => "Required",
            "password" => "Required",
        ]);
       
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return view('index');
        } else {
            $request->session()->invalidate();
            //  return view('login',['data'=>'notuser']);
            return redirect()->back()->with('error','invalid user');
        }}
        return view("login");
    }

    public function registration(Request $request)
    {
        if($request->isMethod("post")){

        $validator = Validator::make($request->all(), [
            "email" => "required|email|unique:users,email",
            "password" => "Required",
            "name" => "Required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        if ($user) {
            return view('login');
        } else {
            return view("registration",['data'=>"register"]);
        }
    }
    return view("registration");
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return view("login");
    }
}
