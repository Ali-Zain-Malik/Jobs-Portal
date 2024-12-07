<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\user\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SkillsController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return view("admin.skills", compact("skills"));
    }

    public function addSkill(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "skill" => "required|max:128",
        ]);

        if ($validator->fails())
        {
            return response()->json([
                "success"   => false,
                "message"=> $validator->errors()->first(),
            ]);
        }

        DB::beginTransaction();
        try
        {
            $skill = new Skill();
            $skill->skill_name = $request->input("skill");
            $skill->is_approved = $request->input("status", 1);
            $skill->save();

            DB::commit();
            return response()->json([
                "success"=> true,
                "message"=> "Skill added",
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                "success"=> false,
                "message"=> $e->getMessage(),
            ]);
        }
    }

    public function getSkill(string $id)
    {
        $skill = Skill::find($id);
        if (!$skill)
        {
            return response()->json([
                "success"=> false,
                "message"=> "Skill not found"
            ], 404);
        }

        return response()->json($skill);
    }

    public function editSkill(string $id,Request $request)
    {
        $skill = Skill::findOrFail($id);
        if(empty($skill))
        {
            return response()->json([
                "success"=> false,
                "message"=> "Skill not found",
            ]);
        }

        $validator = Validator::make($request->all(), [
            "skill"=> "required|max:128",
        ]);

        if ($validator->fails())
        {
            return response()->json([
                "success"=> false,
                "message"=> $validator->errors()->first(),
            ]);
        }

        DB::beginTransaction();
        try
        {
            $skill->skill_name = $request->input("skill");
            $skill->is_approved = $request->input("status",1);
            $skill->save();

            DB::commit();
            return response()->json([
                "success"=> true,
                "message"=> "Skill updated",
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                "success"=> false,
                "message"=> $e->getMessage(),
            ]);
        }

    }
}
