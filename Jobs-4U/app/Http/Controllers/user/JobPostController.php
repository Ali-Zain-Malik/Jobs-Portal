<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\City;
use App\Models\user\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    public function index()
    {
        $cities =   City::all();
        $skills =   Skill::where("is_approved", 1)->get();
        return view("user.job_post", compact("cities", "skills"));
    }
}
