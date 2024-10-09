<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Education;
use App\Models\user\Experience;
use App\Models\user\Skill;
use App\Models\user\User;
use App\Models\user\User_skill;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {   
        $skills =   Skill::where("is_approved", 1)->get();
        $user_skills    =   User_skill::where("user_id", Auth::id())
                                    ->join("skills", "skills.id", "=", "user_skills.skill_id")
                                    ->where("is_approved", 1)
                                    ->get();

        $user_experience    =   Experience::where("user_id", Auth::id())->get();
        $user_education     =   Education::where("user_id", Auth::id())->get();

        return view("user.profile_page", [
            "skills"            =>  $skills,
            "user_skills"       =>  $user_skills,
            "user_experience"   =>  $user_experience,
            "user_education"    =>  $user_education
        ]);
    }

    public function viewProfile(string $id)
    {
        $validator  =   Validator::make(["id" => $id],[
            "id"    =>  "required|integer|exists:users,id"
        ]);

        if($validator->fails())
        {
            return redirect()->route("job.applicantRequests")->withErrors($validator);
        }

        $user   =   User::find($id);
        if($user)
        {
            $user_skills    =   User_skill::where("user_id", $user->id)
                                ->join("skills", "skills.id", "=", "user_skills.skill_id")
                                ->where("is_approved", 1)
                                ->get();

            $user_experience    =   Experience::where("user_id", $id)->get();
            $user_education     =   Education::where("user_id", $id)->get();

            return view("user.view_applicant_profile", compact("user", "user_skills", "user_experience", "user_education"));
        }
        else
        {
            return redirect()->back()->with("notFound", "User not found");
        }
    }

    public function downloadProfilePdf(string $id)
    {
        $validator  =   Validator::make(["id" => $id],[
            "id"    =>  "required|integer|exists:users,id"
        ]);

        if($validator->fails())
        {
            return redirect()->route("job.applicantRequests")->withErrors($validator);
        }

        $user   =   User::find($id);
        if($user)
        {
            $user_skills    =   User_skill::where("user_id", $user->id)
                                ->join("skills", "skills.id", "=", "user_skills.skill_id")
                                ->where("is_approved", 1)
                                ->get();

            $user_experience    =   Experience::where("user_id", $id)->get();
            $user_education     =   Education::where("user_id", $id)->get();
            $data   =   [
                "user"  =>  $user,
                "user_skills"   =>  $user_skills,
                "user_experience"   =>  $user_experience,
                "user_education"    =>  $user_education
            ];
            $pdf    =   app(PDF::class)->loadview("user.profile_pdf", $data);   
            return $pdf->download("profile.pdf");         
        }
        else
        {
            return redirect()->back()->with("", "User not found");
        }
    }
}
