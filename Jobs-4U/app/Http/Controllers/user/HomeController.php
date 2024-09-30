<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Category;
use App\Models\user\City;
use App\Models\user\Job;
use App\Models\user\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {  
        $categories     = Category::where('is_active', 1)
                                    ->withCount(['jobs' => function($query) 
                                    {
                                        $query->where('is_approved', 1)
                                            ->where('is_featured', 1)
                                            ->where('expiry_date', '>=', date('Y-m-d'));
                                    }])
                                    ->inRandomOrder()
                                    ->limit(8)
                                    ->get();

        $jobs           =   Job::join("users", "jobs.user_id", "=", "users.id")
                                ->join("cities", "jobs.city_id", "=", "cities.id")
                                ->where("jobs.is_approved", 1)
                                ->where("jobs.is_featured", 1)
                                ->where("jobs.expiry_date", ">=", date("Y-m-d"))
                                ->select("jobs.*", "jobs.id as jobID", "cities.*", "users.*")
                                ->inRandomOrder()->limit(8)->get();

        
        $top_employers  =   User::where("is_top_employer", 1)
                                ->where("role", "employer")
                                ->join("cities", "users.city_id", "=", "cities.id")
                                ->select('users.*', 'city_name') // In eloquoent when we define join we need to tell that which column is required. 
                                ->withCount("jobs")
                                ->get();
                                
        $all_locations  =   City::all();
        $user           =   auth()->user();
        // return $favJob;
        return view("user.home", [
            "categories"    =>  $categories,
            "jobs"          =>  $jobs,
            "top_employers" =>  $top_employers,
            "locations"     =>  $all_locations,
            "user"          =>  $user
        ]);
    }


   }
