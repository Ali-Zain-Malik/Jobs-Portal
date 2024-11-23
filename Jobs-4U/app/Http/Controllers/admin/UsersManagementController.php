<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\user\City;
use App\Models\user\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersManagementController extends Controller
{
    public function index()
    {
        $loggedInUser = Auth::user();
        if($loggedInUser->role != "admin")
        {
            return redirect()->route("admin.signin")->with("message", "Unauthorized");
        }

        $users = User::whereNot("role", "admin")->orderBy("id", "DESC")->get();
        return view("admin.users", compact("users"));
    }

    public function addUserView()
    {
        return view("admin.add_user");
    }

    public function add(Request $request)
    {
        $loggedInUser = Auth::user();
        if($loggedInUser->role != "admin")
        {
            return redirect()->route("admin.signin")->with("message", "Unauthorized");
        }

        $validator = Validator::make($request->all(), [
            "name"      =>  "required|min:3|max:30",
            "email"     =>  "required|email|unique:users",
            "role"      =>  "required|in:employer,applicant",
            "password"  =>  "required|min:8|confirmed",
        ]);

        if($validator->fails())
        {
            return redirect()->route("userAdd.view")->withInput()->withErrors($validator);
        }

        DB::beginTransaction();
        try
        {
            $user = new User();
            $user->fill([
                "name"      =>  $request->name,
                "email"     =>  $request->email,
                "role"      =>  $request->role,
                "password"  =>  Hash::make($request->password),
                "signup_date" => date("Y-m-d"),
            ]);
            $user->save();
            DB::commit();
            return redirect()->route("users.management")->with("success", "User added successfully");
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return redirect()->back()->with("error", "Something went wrong");
        }
    }

    public function profile(string $id)
    {
        $user = User::leftJoin("cities", "users.city_id", "cities.id")
                    ->where("users.id", $id)
                    ->select("users.*", "cities.id as city_id", "cities.city_name")
                    ->first();
        if(empty($user))
        {
            return redirect()->back()->with("error", "User does not exist");
        }

        $cities = City::all();
        return view("admin.user_profile", compact("user", "cities"));
    }

    public function editProfile(string $id, Request $request)
    {
        $user = User::where("id", $id)->first();

        if(empty($user))
        {
            return redirect()->back()->with("error", "Invalid User");
        }

        $validator = Validator::make($request->all(), [
            "profile_pic"   =>  "nullable|image|mimes:jpg, jpeg, png",
            "name"          =>  "required|min:3|max:32",
            "about"         =>  "nullable|max:255",
            "email"         =>  "required|email|unique:users,email," . $user->id,
            "date_of_birth" =>  "nullable|date",
            "city"          =>  "nullable",
            "role"          =>  "required|in:applicant,employer",
            "top-emp"       =>  "required|boolean",
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        DB::beginTransaction();
        try
        {
            $user->fill([
                "name"              =>  $request->input("name"),
                "email"             =>  $request->input("email"),
                "role"              =>  $request->input("role"),
                "city_id"           =>  $request->input("city", NULL),
                "is_top_employer"   =>  $request->input("top-emp"),
                "date_of_birth"     =>  $request->input("date_of_birth", NULL),
                "description"       =>  $request->input("about", NULL),
            ]);
            $user->save();
    
            if(!empty($_FILES["profile_pic"]["tmp_name"]))
            {
                $oldImage = public_path("storage/" . $user->profile_pic);
                if(file_exists($oldImage))
                {
                    @unlink($oldImage);
                }
    
                $newImage = $request->file("profile_pic");
                $extension = $newImage->extension();
                $fileName = time() . "_" . Str::random(10) . "." . $extension;
                $filePath = $newImage->storeAs("images", $fileName, "public");
                $user->profile_pic = $filePath;
                $user->save();
            }
            DB::commit();
            return redirect()->back()->with("success", "Profile Updated");
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
            return redirect()->back()->with("error", "Something went wrong");   
        }
    }

    public function removeProfilePhoto(string $id)
    {
        $user = User::find($id);
        if(empty($user))
        {
            return response()->json([
                "message" => "Invalid User"
            ], 400);
        }
        DB::beginTransaction();
        try
        {
            $photo = public_path("storage/" . $user->profile_pic);
            if(file_exists($photo))
            {
                @unlink($photo);
            }
            
            $user->profile_pic = NULL;
            $user->save();
            DB::commit();
            return response()->json([
                "message" => "Profile photo removed"
            ], 200);
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return response()->json([
                "message" => "Something went wrong"
            ], 500);
        }
       
    }
}
