<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Education;
use App\Models\user\Experience;
use App\Models\user\Skill;
use App\Models\user\User;
use App\Models\user\User_skill;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
}
