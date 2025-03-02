<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Feedbacks;
use App\Models\user\Category;
use App\Models\user\City;
use App\Models\user\Job;
use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        $getFeedbacks = Feedbacks::getFeedbacks(); 
        $feedbacks = [];
        foreach($getFeedbacks as $feedback)
        {
            if($feedback->is_displayed)
            {
                $feedback->feedback = strlen($feedback->feedback) > 270 ? substr($feedback->feedback, 0, 270) . " . . ." : $feedback->feedback;
                $feedbacks[] = $feedback;
            }
        }
        
        return view("user.home", [
            "categories"    =>  $categories,
            "jobs"          =>  $jobs,
            "top_employers" =>  $top_employers,
            "locations"     =>  $all_locations,
            "feedbacks"     =>  $feedbacks,
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

    public function feedback(Request $request)
    {
        $user = Auth::user();
        if(empty($user))
        {
            return response()->json([
                "success"   =>  false,
                "message"   =>  "You need to login to perform this action",
            ], 401);
        }

        $validtor = Validator::make($request->all(), [
            "feedback"  =>  "required|min:10|max:270",
        ]);

        if($validtor->fails())
        {
            return response()->json([
                "success"   =>  false,
                "message"   =>  $validtor->errors()->first(), // Because there will be just error
            ], 400);
        }

        DB::beginTransaction();
        try
        {
            $feedback = Feedbacks::where("user_id", $user->id)->first();
            if(empty($feedback)) // If the current user has no previous feedback
            {
                $feedback = new Feedbacks();
                $feedback->fill([
                    "user_id"   =>  $user->id,
                    "feedback"  =>  $request->feedback,
                    "feedback_date" =>  Date("Y-m-d"),
                ]);
            }
            else // If the user is updating feedback.
            {
                $feedback->fill([
                    "feedback"      =>  $request->feedback,
                    "feedback_date" =>  Date("Y-m-d"),
                    "is_displayed"  =>  0, // Reset the feedback status
                ]);
            }

            $feedback->save();
            DB::commit();

            return response()->json([
                "success"   =>  true,
                "message"   =>  "Feedback added successfully",
            ], 200);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                "success"   =>  false,
                "message"   =>  "Something went wrong 😥",
            ], 500);
        }
    }
}
