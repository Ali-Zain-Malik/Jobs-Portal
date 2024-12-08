<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\user\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::join("users", "users.id", "=", "jobs.user_id")
                ->select("jobs.*", "users.name as employer")
                ->get();
        return view("admin.jobs", compact("jobs"));
    }

    public function getJob(string $id)
    {
        $job = Job::find($id);
        if (!$job) 
        {
            return response()->json([
                "success" => false,
                "message"=> "Job not found",
            ],404);
        }

        return response()->json([
            "success"=> true,
            "job" => $job->toArray(),
        ],200);
    }

    public function toggleApprove(string $id, Request $request)
    {
        $job = Job::find($id);
        if (!$job)
        {
            return response()->json([
                "success"=> false,
                "message"=> "Job not found",
            ],404);
        }

        DB::beginTransaction();
        try
        {
            $job->is_approved = $request->input("is_approved", 1);
            $job->save();
            DB::commit();

            return response()->json([
                    "success"=> true,
                    "message"=> $job->is_approved ? "Job approved" : "Job declined",
                ],200);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                "success"=> false,
                "message"=> $e->getMessage(),
            ],500);
        }
    }


    public function toggleFeature(string $id, Request $request)
    {
        $job = Job::find($id);
        if (!$job)
        {
            return response()->json([
                "success"=> false,
                "message"=> "Job not found",
            ],404);
        }

        DB::beginTransaction();
        try
        {
            $job->is_featured = $request->input("is_featured", 1);
            $job->save();
            DB::commit();

            return response()->json([
                    "success"=> true,
                    "message"=> $job->is_featured ? "Job added to featured" : "Job removed removed from featured",
                ],200);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                "success"=> false,
                "message"=> $e->getMessage(),
            ],500);
        }
    }
}
