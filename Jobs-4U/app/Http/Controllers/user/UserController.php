<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Skill;
use App\Models\user\User;
use App\Models\user\User_skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function PHPSTORM_META\map;

class UserController extends Controller
{
    public function index()
    {
        $user   =   auth()->user();
        
        $skills =   Skill::where("is_approved", 1)->get();
        $user_skills    =   User_skill::where("user_id", Auth::id())
                                    ->join("skills", "skills.id", "=", "user_skills.skill_id")
                                    ->where("is_approved", 1)
                                    ->get();
        // return $user_skills;
        return view("user.profile_page", [
            "user"          =>  $user,
            "skills"        =>  $skills,
            "user_skills"   =>  $user_skills
        ]);
    }

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
        return "No skill added";
    }
}
