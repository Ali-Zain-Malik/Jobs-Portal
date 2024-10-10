<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view("user.signup");
    }

    public function signin()
    {
        return view("user.signin");
    }

    public function createAccount(Request $request)
    {
        $validator      =   Validator::make($request->all(), [
            "email"     =>  "required|email|unique:users",
            "name"      =>  "required|min:3|max:30",
            "password"  =>  [
                'required',
                'min:8',
                'confirmed', 
                'regex:/[a-z]/', 
                'regex:/[A-Z]/', 
                'regex:/[0-9]/', 
                'regex:/[@$!%*?&#]/'
            ],
            "password_confirmation" =>  "required"
        ]);

        // Custom error message for validating password
        // $regexError =   'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.';

        if($validator->passes())
        {
            $user               =   new User();
            $user->name         =   $request->name;
            $user->email        =   $request->email;
            $user->role         =   $request->role  ??  "applicant";
            $user->password     =   Hash::make($request->password);
            $user->emp_company  =   $request->emp_company   ??  NULL;
            $user->signup_date  =   date("Y-m-d");

            if($user->save())
            {
                return redirect()->route("user.signin")->with("success", "Account Created Successfully");
            }
            else
            {
                return redirect()->route("user.signup")->with("error", "Failed to create Account")->withInput();
            }
        }
        else
        {
            return redirect()->route("user.signup")->withInput()->withErrors($validator);
        }
    }


    public function authenticate(Request $request)
    {
        $validator      =   Validator::make($request->all(), [
            "email"     =>  "required|email",
            "password"  =>  "required"
        ]);

            if($validator->passes())
            {
                $credentials    =   $request->only("email", "password");

                
                if(Auth::attempt($credentials))
                {
                    return redirect()->route("user.home");
                }
                else
                {
                    return redirect()->route("user.signin")->with("error", "Either email or password is Incorrect. 😥")->withInput();
                }
            }
            else
            {
                return redirect()->route("user.signin")->withErrors($validator)->withInput();
            }    
    }


    public function signout()
    {
        Auth::logout();  // Log out the authenticated user
        return redirect()->route('user.signin'); 
    }
}
