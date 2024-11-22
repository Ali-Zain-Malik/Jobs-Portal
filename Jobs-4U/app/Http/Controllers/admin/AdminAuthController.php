<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view("admin.signin");
    }

    public function adminAuthenticate(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "email"     =>  "required|email",
            "password"  =>  "required"
        ]);

        if($validator->fails())
        {
            return redirect()->route("admin.signin")->withErrors($validator);
        }

        $credentials    =   $request->only("email", "password");
        if(Auth::guard("admin")->attempt($credentials))
        {
            if(Auth::guard("admin")->user()->role != "admin")
            {
                Auth::guard("admin")->logout();
                return redirect()->route("admin.signin")->with("error", "You are not authorized to access this page.");
            }
            $user = User::where("email", $request->email)->first();
            Auth::login($user);
            return redirect()->route("admin.dashboard");
        }
        else
        {
            return redirect()->route("admin.signin")->with("error", "Either email or password is incorrect!");
        }
    }
}
