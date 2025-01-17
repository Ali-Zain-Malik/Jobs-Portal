<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Category;
use App\Models\user\City;
use App\Models\user\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search_input   =   $request->input("search-input") ??  NULL;
        $city_id        =   $request->input("city-id")      ??  NULL;
        $category_id    =   $request->input("category")     ??  NULL;

        $query          =   Job::join('cities', 'cities.id', '=', 'jobs.city_id')
                                ->join('categories', 'categories.id', '=', 'jobs.category_id')
                                ->select("jobs.*", "cities.city_name")
                                ->where('jobs.expiry_date', '>=', date('Y-m-d'))
                                ->where("jobs.user_id", "!=", Auth::id()); // Don't show user's own posted jobs

        if(!empty($search_input))
        {
            // To add paranthesis so that there will be no confusions due to OR operator
            $query->where(function ($q) use ($search_input)
            {
                $q->where('job_title', 'like', "%{$search_input}%")
                    ->orWhere('job_description', 'like', "%{$search_input}%");
            });
        }

        if(!empty($city_id))
        {
            $query->where('cities.id', $city_id);
        }

        if(!empty($category_id))
        {
            $query->where('categories.id', $category_id);
        }

        $jobs    =   $query->get();

        $all_locations  =   City::all();
        $all_categories =   Category::where("is_active", 1)->get();
        if(isset($city_id))
        {
            $city_name      =   City::where("id", $city_id)->select("cities.city_name")->first();
        }
        
        if(isset($category_id))
        {
            $category_name  =   Category::where("id", $category_id)->select("categories.category_name")->first();
        }

        return view("user.search_page", [
            "jobs"          =>  $jobs,
            "search_input"  =>  $search_input,
            "locations"     =>  $all_locations,
            "categories"    =>  $all_categories,
            "city_id"       =>  $city_id,
            "city_name"     =>  $city_name ?? NULL,
            "category_id"   =>  $category_id,
            "category_name" =>  $category_name ?? NULL
        ]);
    }
}

