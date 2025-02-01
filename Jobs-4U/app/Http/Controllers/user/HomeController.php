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
                                            ->where('expiry_date', '>=', date('Y-m-d'));
                                    }])
                                    ->inRandomOrder()
                                    ->limit(8)
                                    ->get();

        $jobs           =   Job::join("cities", "jobs.city_id", "=", "cities.id")
                                ->where("jobs.is_approved", 1)
                                ->where("jobs.is_featured", 1)
                                ->where("jobs.expiry_date", ">=", date("Y-m-d"))
                                ->select("jobs.*", "cities.city_name")
                                ->inRandomOrder()->limit(8)->get();

        
        $top_employers  =   User::where("is_top_employer", 1)
                                ->select('users.id', 'users.name', 'users.city_id', 'users.profile_pic', 'users.emp_company')
                                ->withCount("jobs")
                                ->get();

        if($top_employers->isNotEmpty())
        {
            // Add city_name and re-construct $top_employers
            $top_employers = $top_employers->map(function ($top) {
                $top["city_name"] = $top->getCity();
                return $top;
            });
        }

        $all_locations  =   City::all();

        return view("user.home", [
            "categories"    =>  $categories,
            "jobs"          =>  $jobs,
            "top_employers" =>  $top_employers,
            "locations"     =>  $all_locations
        ]);
    }


    public function exploreCategory(string $id)
    {
        $category = Category::where("id", $id)->first();
        if(empty($category))
        {
            return redirect()->back();
        }

        $jobs = Job::join("cities", "jobs.city_id", "=", "cities.id")
                    ->where("jobs.is_approved", 1)
                    ->where("jobs.expiry_date", ">=", date("Y-m-d"))
                    ->where("category_id", $id)
                    ->select("jobs.*", "cities.city_name")
                    ->get();
        
        return view("user.explore_category", compact("jobs","category"));
    }
   }
