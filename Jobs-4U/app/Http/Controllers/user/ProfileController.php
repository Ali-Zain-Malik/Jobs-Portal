<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Skill;
use App\Models\user\User_skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user   =   auth()->user();
        
        $skills =   Skill::where("is_approved", 1)->get();
        $user_skills    =   User_skill::where("user_id", Auth::id())
                                    ->join("skills", "skills.id", "=", "user_skills.skill_id")
                                    ->where("is_approved", 1)
                                    ->get();
        // return $user_skills;
        return view("user.profile_page", [
            "user"          =>  $user,
            "skills"        =>  $skills,
            "user_skills"   =>  $user_skills
        ]);
    }
}
