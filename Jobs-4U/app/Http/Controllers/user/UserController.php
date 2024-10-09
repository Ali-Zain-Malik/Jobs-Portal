<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Education;
use App\Models\user\Experience;
use App\Models\user\Job;
use App\Models\user\Job_applicant;
use App\Models\user\Skill;
use App\Models\user\User;
use App\Models\user\User_skill;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class UserController extends Controller
{
    public function changeProfilePic(Request $request)
    {
        if($request->hasFile("new_profile_img"))
        {
            $validator  =   Validator::make($request->all(),[
                "new_profile_img"   =>  "required|image|mimes:jpg,jpeg,png"
            ]);

            if($validator->fails())
            {
                return response()->json([
                    "success"   =>  false,
                    "error"   =>  $validator->errors()
                ]);
            }

            $user               =   auth()->user();

            if ($user->profile_pic) 
            {
                // Delete the old image from the server
                $oldImagePath = public_path('storage/' . $user->profile_pic);
                if (file_exists($oldImagePath)) 
                {
                    unlink($oldImagePath); // Delete the old image file
                }
            }

            $image      =   $request->file("new_profile_img");
            $fileName   =   time() . "_" . Str::random(10) . "." . $image->getClientOriginalExtension();
            $imagePath  =   $image->storeAs("images", $fileName, "public"); 

            
            $user->profile_pic  =   $imagePath;
            $user->save();

            return response()->json([
                "success"   =>  true,
                "message"   =>  "Profile image updated successfully"
            ]);
        }

        return response()->json([
            "success"   =>  false,
            "error"     =>  "No file selected"
        ]);
    }


    public function changeName(Request $request)
    {
        if($request->has("name"))
        {
            $validator  =   Validator::make($request->all(),[
                "name"  =>  "required|min:3|max:30"
            ]);
            
            if($validator->fails())
            {
                return response()->json([
                    "success"   =>  false,
                    "error"     =>  $validator->errors()
                ]);
            }

            $name       =   $request->name;
            $user       =   auth()->user();
            $user->name =   $name;
            $user->save();
            return response()->json([
                "success"   =>  true,
                "message"   =>  "Name updated successfully"
            ]);
        }

        return response()->json([
            "success"   =>  false,
            "error"     =>  "Name cannot be empty"
        ]);
    }


    public function updateDescription(Request $request)
    {
        if($request->has("description"))
        {
            $user   =   auth()->user();
            $user->description  =   $request->description;
            $user->save();
            return response()->json([
                "success"   =>  true,
                "message"   =>  "Description updated successfully"
            ]); 
        }

        User::where("id", Auth::id())->update(["description" => NULL]);
    }

    public function updateSkills(Request $request)
    {
        if($request->has("skills"))
        {
            $new_user_skills    =   $request->skills;
            User_skill::where("user_id", Auth::id())->delete();

            foreach($new_user_skills as $skill_id)
            {
                User_skill::create([
                    "user_id"   =>  Auth::id(),
                    "skill_id"  =>  $skill_id
                ]);      
            }
            return response()->json([
                "success"   =>  true,
                "message"   =>  "Skills updated successfully"
            ]); 
        }

        User_skill::where("user_id", Auth::id())->delete();
    }


    public function addExperience(Request $request)
    {
        $start_month    =   $request->start_month ?? NULL;
        $start_year     =   $request->start_year ?? NULL;
        $end_month      =   $request->end_month ?? NULL;
        $end_year       =   $request->end_year ?? NULL;
        
        $start_date     =   NULL;
        if($start_month && $start_year)
        {
            $start_date     =   new DateTime("$start_year-$start_month-01");
            $start_date     =   $start_date->format("Y-m-d");
        }

        $end_date       =   NULL;
        if($end_month && $end_year)
        {
            $end_date   =   new DateTime("$end_year-$end_month-01");
            $end_date   =   $end_date->format("Y-m-d");
        }

        $validator              =   Validator::make([
            "designation"       =>  $request->designation,
            "company"           =>  $request->company,
            "employment_type"   =>  $request->employment_type,
            "location_type"     =>  $request->location_type,
            "start_date"        =>  $start_date,
            "end_date"          =>  $end_date ?? NULL
        ],
        [
            "designation"       =>  "required",
            "company"           =>  "required",
            "employment_type"   =>  "required",
            "location_type"     =>  "required",
            "start_date"        =>  "required|date",
            "end_date"          =>  "nullable|date|" 
        ]);

        $validator->after(function ($validator) use ($start_date, $end_date) 
        {
            if ($end_date && strtotime($start_date) > strtotime($end_date)) 
            {
                $validator->errors()->add('end_date', "End date can't be earlier than the start date.");
            }
        });

        if($validator->fails())
        {
            return response()->json([
                "success"   =>  false,
                "error"     =>  $validator->errors()
            ]);
        }

        Experience::create([
            "user_id"           =>  Auth::id(),
            "designation"       =>  $request->designation,
            "company"           =>  $request->company,
            "employment_type"   =>  $request->employment_type,
            "location_type"     =>  $request->location_type,
            "start_date"        =>  $start_date,
            "end_date"          =>  $end_date ?? NULL
        ]);

        return response()->json([
            "success"   =>  true,
            "message"   =>  "Experience added successfully"
        ]);
    }

    public function addEducation(Request $request)
    {
        $start_month    =   $request->start_month ?? NULL;
        $start_year     =   $request->start_year ?? NULL;
        $end_month      =   $request->end_month ?? NULL;
        $end_year       =   $request->end_year ?? NULL;
        
        $start_date     =   NULL;
        if($start_month && $start_year)
        {
            $start_date     =   new DateTime("$start_year-$start_month-01");
            $start_date     =   $start_date->format("Y-m-d");
        }

        $end_date       =   NULL;
        if($end_month && $end_year)
        {
            $end_date   =   new DateTime("$end_year-$end_month-01");
            $end_date   =   $end_date->format("Y-m-d");
        }

        $validator              =   Validator::make([
            "program"       =>  $request->program,
            "major"         =>  $request->major,
            "institute"     =>  $request->institute,
            "grade"         =>  $request->grade,
            "start_date"    =>  $start_date,
            "end_date"      =>  $end_date ?? NULL
        ],
        [
            "program"       =>  "required",
            "major"         =>  "required",
            "institute"     =>  "required",
            "grade"         =>  "required",
            "start_date"    =>  "required|date",
            "end_date"      =>  "nullable|date|" 
        ]);

        $validator->after(function ($validator) use ($start_date, $end_date) 
        {
            if ($end_date && strtotime($start_date) > strtotime($end_date)) 
            {
                $validator->errors()->add('end_date', "End date can't be earlier than the start date.");
            }
        });

        if($validator->fails())
        {
            return response()->json([
                "success"   =>  false,
                "error"     =>  $validator->errors()
            ]);
        }

        Education::create([
            "user_id"       =>  Auth::id(),
            "program"       =>  $request->program,
            "major"         =>  $request->major,
            "institute"     =>  $request->institute,
            "grade"         =>  $request->grade,
            "start_date"    =>  $start_date,
            "end_date"      =>  $end_date ?? NULL
        ]);

        return response()->json([
            "success"   =>  true,
            "message"   =>  "Education added successfully"
        ]);
    }

    public function deleteExperience(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "id"    =>  "required|integer"
        ]);

        if($validator->fails())
        {
            return response()->json([
                "success"   =>  false,
                "error"     =>  $validator->errors()
            ]);
        }

        Experience::destroy($request->id);
        return response()->json([
            "success"   =>  true,
            "message"   =>  "Experience deleted successfully"
        ]);
    }
    public function deleteEducation(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "id"    =>  "required|integer"
        ]);

        if($validator->fails())
        {
            return response()->json([
                "success"   =>  false,
                "error"     =>  $validator->errors()
            ]);
        }

        Education::destroy($request->id);
        return response()->json([
            "success"   =>  true,
            "message"   =>  "Education deleted successfully"
        ]);
    }

    public function changeRole()
    {
        $user       =   auth()->user();
        $role       =   $user->role;
        $newRole    =   $role == "employer" ? "applicant" : "employer";
        $user->role =   $newRole;
        if($user->save())
        {
            return redirect()->route("user.home")->with("success", "Role Changed Successfully");
        }
        else
        {
            return redirect()->route("user.home")->with("error", "Couldn't change role. An error occured");
        }

    }


    public function myPosts()
    {
        $jobs   =   Job::join("cities", "jobs.city_id", "=", "cities.id")
                        ->where("user_id", Auth::id())
                        ->select("jobs.*", "jobs.id as jobID", "cities.*")
                        ->get();

        return view("user.my_posts", compact("jobs"));
    }

    public function deletePost(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "post_id"   =>  "required|integer|exists:jobs,id"
        ]);

        if($validator->fails())
        {
            return response()->json([
                "success"   =>  false,
                "error"     =>  $validator->errors()
            ]);
        }

        $post   =   Job::find($request->post_id);
        if($post)
        {
            $post->delete();
            return response()->json([
                "success"   =>  true,
                "message"   =>  "Post has been deleted"
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong. Post not found.',
            ]);
        }
    }


    public function applicantRequests()
    {
        $jobs           =   Job::where("user_id", Auth::id())->get();
        $job_ids        =   $jobs->pluck("id");
        $job_applicants =   Job_applicant::whereIn("job_id", $job_ids)
                                        ->join("users", "users.id", "=", "job_applicants.applicant_id")
                                        ->join("jobs", "jobs.id", "=", "job_applicants.job_id")
                                        ->select("job_applicants.id as application_id",
                                                "users.id as applicant_id", 
                                                "users.name as name", 
                                                "users.profile_pic as profile_pic", 
                                                "jobs.job_title as job_title"
                                            )
                                        ->get();

        return view("user.applicant_requests", compact("job_applicants"));
    }


    public function applicantDetails(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "application_id"   =>  "required|integer"
        ]);

        if($validator->fails())
        {
            return response()->json([
                "success"   =>  false,
                "error"     =>  $validator->errors()
            ], 400);
        }

        $details    =   Job_applicant::find($request->application_id);
        if(empty($details))
        {
            return response()->json([
                "success"   =>  false,
                "error"     =>  "No details found for this application"
            ],404);
        }

        return response()->json([
            "success"   =>  true,
            "details"   =>  $details
        ],200);
    }

    public function settingsView()
    {
        $user   =   Auth::user();
        return view("user.settings", compact("user"));
    }

    public function DOB(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "dob"   =>  "required|date"
        ]);

        if($validator->fails())
        {
            return response()->json([
                "success"   =>  false,
                "error"     =>  $validator->errors()
            ]);
        }

        $user   =   Auth::user();
        $user->date_of_birth    =   $request->dob;
        $user->save();

        return response()->json([
            "success"   =>  true,
            "message"   =>  "Date of birth updated successfully"
        ]);
    }


    public function changePassword(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "old-password"  =>  "required",
            "new-password"  =>  [
                'required',
                'min:8', 
                'regex:/[a-z]/', 
                'regex:/[A-Z]/', 
                'regex:/[0-9]/', 
                'regex:/[@$!%*?&#]/'
            ]
        ]);

        if($validator->fails())
        {
            return redirect()->route("user.settings")->withErrors($validator)->withInput();
        }

        if(Hash::check($request->input('old-password'), Auth::user()->password))
        {
            Auth::user()->password =  Hash::make($request->input("new-password"));
            Auth::user()->save();
            Auth::logout();
            return redirect()->route("user.signin")->with("success", "Password changed successfully. Please sign in again.");
        }
        else
        {
            return redirect()->route("user.settings")->with("error", "Old password doesnot match")->withInput();
        }
    }
}
