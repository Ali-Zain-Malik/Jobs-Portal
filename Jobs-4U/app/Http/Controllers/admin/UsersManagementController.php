<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersManagementController extends Controller
{
    public function index()
    {
        $loggedInUser = Auth::user();
        if($loggedInUser->role != "admin")
        {
            return redirect()->route("admin.signin")->with("message", "Unauthorized");
        }

        $users = User::whereNot("role", "admin")->orderBy("id", "DESC")->get();
        return view("admin.users", compact("users"));
    }

    public function addUserView()
    {
        return view("admin.add_user");
    }

    public function add(Request $request)
    {
        $loggedInUser = Auth::user();
        if($loggedInUser->role != "admin")
        {
            return redirect()->route("admin.signin")->with("message", "Unauthorized");
        }

        $validator = Validator::make($request->all(), [
            "name"      =>  "required|min:3|max:30",
            "email"     =>  "required|email|unique:users",
            "role"      =>  "required|in:employer,applicant",
            "password"  =>  "required|min:8|confirmed",
        ]);

        if($validator->fails())
        {
            return redirect()->route("userAdd.view")->withInput()->withErrors($validator);
        }

        DB::beginTransaction();
        try
        {
            $user = new User();
            $user->fill([
                "name"      =>  $request->name,
                "email"     =>  $request->email,
                "role"      =>  $request->role,
                "password"  =>  Hash::make($request->password),
                "signup_date" => date("Y-m-d"),
            ]);
            $user->save();
            DB::commit();
            return redirect()->route("users.management")->with("success", "User added successfully");
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return redirect()->back()->with("error", "Something went wrong");
        }
    }
}
