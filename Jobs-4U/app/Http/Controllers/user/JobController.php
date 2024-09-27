<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use App\Models\user\Favorite_job;
use App\Models\user\Job;
use App\Models\user\Job_applicant;
use App\Models\user\Job_skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $favorite_job   =   Favorite_job::where("user_id", Auth::id())->get();
        foreach($favorite_job as $fav)
        {
            $jobs []  =   Job::where("jobs.id", $fav->job_id)
                                ->join("users", "jobs.user_id", "=", "users.id")
                                ->join("cities", "jobs.city_id", "=", "cities.id")
                                ->where("jobs.is_approved", 1)
                                ->where("jobs.is_featured", 1)
                                ->where("jobs.expiry_date", ">=", date("Y-m-d"))
                                ->select("jobs.*", "jobs.id as jobID", "cities.*", "users.*")
                                ->first();
        }

        if(empty($jobs))
        {
            return view("user.favorites", ["empty" => "empty"]);
        }
        else
        {
            return view("user.favorites", compact("jobs"));
        }
    }

    public function favorite(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "job_id" => "required|integer|exists:jobs,id"
        ]);

        if($validator->passes())
        {
            $job_id     =   $request->input("job_id");
            $user_id    =   Auth::id();

            $favorite_job   =   Favorite_job::where("user_id", $user_id)
                                            ->where("job_id", $job_id)
                                            ->first();

            if($favorite_job)
            {
                // If it is already there then
                $favorite_job->delete();
                return response()->json([
                    "message"   =>  "Removed from favorites",
                    "success"   =>  true
                ]);
            }
            else
            {
                // If not then we will add it
                $addFav =   new Favorite_job();
                $addFav->user_id    =   $user_id;
                $addFav->job_id     =   $job_id;
                
                if($addFav->save())
                {
                    return response()->json([
                        "message"   =>  "Added to favorties",
                        "success"   =>  true
                    ]);
                }
            }
        }
    }


    public function viewJob(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "job_id" => "required|integer|exists:jobs,id"
        ]);

        if($validator->passes())
        {
            $job_id         =   $request->input("job_id");
            $job_details    =   Job::where("id", $job_id)->first();
            $job_skills     =   Job_skill::join("skills", "skills.id", "=", "job_skills.skill_id")
                                        ->where("job_skills.job_id", $job_id)->get();

            if($job_details)
            {
                return response()->json([
                    "success"       =>  true,
                    "job_details"   =>  $job_details,
                    "job_skills"    =>  $job_skills
                ]);
            }
        }
    }


    public function applyJob(Request $request)
    {
        $job_id         =   $request->input("job_id");
        $description    =   $request->input("description")  ??  NULL;

        $job_applicant  =   Job_applicant::where("applicant_id", Auth::id())
                                        ->where("job_id", $job_id)->first();
        
        if($job_applicant)
        {
            return response()->json([
                "success"   =>  true,
                "message"   =>  "You have already applied for this job"
            ]);
        }
        else
        {
            $job_applicant                  =   new Job_applicant();
            $job_applicant->applicant_id    =   Auth::id();
            $job_applicant->job_id          =   $job_id;
            $job_applicant->date_applied    =   date("Y-m-d");
            if($description)
            {
                $job_applicant->description =   $description;
            }
    
            if($job_applicant->save())
            {
                return response()->json([
                    "success"   =>  true,
                    "message"   =>  "Applied for the job"
                ]);
            }
        }
    }
}
