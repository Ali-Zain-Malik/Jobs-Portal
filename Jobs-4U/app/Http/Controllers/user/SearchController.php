<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Category;
use App\Models\user\City;
use App\Models\user\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search_input   =   $request->input("search-input");
        $city_id        =   $request->input("city-id");
        $category_id    =   $request->input("category");

        $jobs           =   Job::join("users", "jobs.user_id", "=", "users.id")
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
                                ->where("job_title", "like", "%$search_input%")
                                ->orWhere("job_description", "like", "%$search_input%")
                                ->where("is_featured", 1)->get();

        $all_locations  =   City::all();
        $all_categories =   Category::where("is_active", 1)->get();

        return view("user.search_page", [
            "jobs"          =>  $jobs,
            "search_input"  =>  $search_input,
            "locations"     =>  $all_locations,
            "categories"    =>  $all_categories
        ]);
    }
}
