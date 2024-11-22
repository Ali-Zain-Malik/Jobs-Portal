<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersManagementController extends Controller
{
    public function index()
    {
        $loggedInUser = Auth::user();
        if($loggedInUser->role != "admin")
        {
            return redirect()->route("admin.signin")->with("message", "Unauthorized");
        }

        $users = User::whereNot("role", "admin")->get();
        return view("admin.includes.users", compact("users"));
    }
}
