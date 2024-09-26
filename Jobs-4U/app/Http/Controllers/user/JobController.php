<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use App\Models\user\Favorite_job;
use App\Models\user\Job;
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
        // return $jobs;
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

}
