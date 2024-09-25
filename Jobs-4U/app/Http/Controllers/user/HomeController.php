<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Category;
use App\Models\user\City;
use App\Models\user\Favorite_job;
use App\Models\user\Job;
use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        // $categories     =   Category::where("is_active", 1)->inRandomOrder()->limit(8)->get();
        // $jobs           =   Job::where("is_approved", 1)->where("is_featured", 1)->where("expiry_date", ">=", date("Y-m-d"))->inRandomOrder()->limit(8)->get();   
        $categories         = Category::where('is_active', 1)
                            ->withCount(['jobs' => function($query) 
                            {
                                $query->where('is_approved', 1)
                                    ->where('is_featured', 1)
                                    ->where('expiry_date', '>=', date('Y-m-d'));
                            }])
                            ->inRandomOrder()
                            ->limit(8)
                            ->get();

        $jobs       =   Job::join("users", "jobs.user_id", "=", "users.id")
                            ->join("cities", "jobs.city_id", "=", "cities.id")
                            ->leftJoin("favorite_jobs", function($join)
                            {
                                $join->on("favorite_jobs.job_id", "=", "jobs.id")
                                ->on("favorite_jobs.user_id", "=", "users.id");
                            })
                            ->where("jobs.is_approved", 1)
                            ->where("jobs.is_featured", 1)
                            ->where("jobs.expiry_date", ">=", date("Y-m-d"))
                            ->select("jobs.*", "jobs.id as jobID", "cities.*", "users.*", "favorite_jobs.*", "favorite_jobs.job_id as favJob_id")
                            ->inRandomOrder()->limit(8)->get();


        $top_employers  =   User::where("is_top_employer", 1)
                                ->where("role", "employer")
                                ->join("cities", "users.city_id", "=", "cities.id")
                                ->select('users.*', 'city_name') // In eloquoent when we define join we need to tell that which column is required. 
                                ->withCount("jobs")
                                ->get();

        $all_locations  =   City::all();
// return $jobs;
        return view("user.home", [
            "categories"    =>  $categories,
            "jobs"          =>  $jobs,
            "top_employers" =>  $top_employers,
            "locations"     =>  $all_locations
        ]);
    }


    public function favorite(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "job_id" => "required|integer|exists:jobs,id"
        ]);

        if($validator->passes())
        {
            $job_id     =   $request->input("job_id");
            $user_id    = Auth::id();

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
