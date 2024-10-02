<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Category;
use App\Models\user\City;
use App\Models\user\Job;
use App\Models\user\Job_skill;
use App\Models\user\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobPostController extends Controller
{
    public function index()
    {
        $cities     =   City::all();
        $skills     =   Skill::where("is_approved", 1)->get();
        $categories =   Category::where("is_active", 1)->get();   
        return view("user.job_post", compact("cities", "skills", "categories"));
    }

    public function postJob(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "job-title"         =>  "required|string|min:3|max:128",
            "company"           =>  "required|string|min:3|max:128",
            "employment-type"   =>  "required|in:permanent,part-time,contract,temporary",  
            "location-type"     =>  "required|in:on-site,hybrid,remote",
            "category"          =>  "required|integer",
            "start-date"        =>  "required|date",
            "end-date"          =>  "nullable|date|after_or_equal:start-date",
            "city"              =>  "required|integer", // integer because we will only get its id
            "salary"            =>  "required|integer|min:1",
            "currency"          =>  "required|string|size:3",
            "per-period"        =>  "required|in:month,year",
            "required-skills"   =>  "required|min:1",
            "description"       =>  "required|string|min:255"
        ]);

        if($validator->fails())
        {
            return redirect()->route("job.create")->withInput()->withErrors($validator);
        }

        $job    =   Job::create([
            "user_id"           =>  Auth::id(),
            "city_id"           =>  $request->city,
            "category_id"       =>  $request->category,
            "job_title"         =>  $request->input("job-title"),
            "company"           =>  $request->company,
            "job_description"   =>  $request->description,
            "employment_type"   =>  $request->input("employment-type"),
            "location_type"     =>  $request->input("location-type"),
            "salary"            =>  $request->salary,
            "currency"          =>  $request->currency,
            "per_period"        =>  $request->input("per-period"),
            "created_at"        =>  date("Y-m-d"),
            "start_date"        =>  $request->input("start-date"),
            "expiry_date"       =>  $request->input("end-date") ?? NULL
        ]);

        $job_skills =   $request->input("required-skills");

        if($job_skills)
        {
            foreach($job_skills as $skill)
            {
                Job_skill::create([
                    "job_id"    =>  $job->id,
                    "skill_id"  =>  $skill
                ]);
            }

        }
        return redirect()->route("user.home")->with("success", "Your job has been posted");
    }
}
