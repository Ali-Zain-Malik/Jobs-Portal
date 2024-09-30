<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $user   =   auth()->user();
        return view("user.profile_page", compact("user"));
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
}
