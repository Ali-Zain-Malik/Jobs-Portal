<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\user\Category;
use App\Models\user\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function deleteJob(string $id)
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
            $job->delete();
            DB::commit();
            return response()->json([
                "success"=> true,
                "message"=> "Job deleted",
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


    public function getCategories()
    {
        $categories =   Category::leftJoin("jobs", "jobs.category_id", "=", "categories.id")
                        ->select("categories.*", DB::raw("COUNT(jobs.id) as job_count"))
                        ->groupBy("categories.id")
                        ->get();

        return view("admin.job_categories", compact("categories"));
    }

    public function getCategory(string $id)
    {
        $category = Category::find($id);
        if(empty($category))
        {
            return response()->json([
                "success" => false,
                "message" => "Category not found",
            ], 404);
        }

        return response()->json([
            "success"   =>  true,
            "category"  =>  $category->toArray(),
        ]);
    }

    protected function categoryValidator($data = [])
    {
        return Validator::make($data,[
            "category_name" => "required|max:128",
            "is_active"     =>  "boolean",
        ]);
    }

    public function editCategory(string $id, Request $request)
    {
        $category = Category::find($id);
        if(empty($category))
        {
            return response()->json([
                "success" => false,
                "message" => "Category not found",
            ]);
        }

        $validator = $this->categoryValidator($request->all());

        if($validator->fails())
        {
            return response()->json([
                "success" =>  false,
                "message" =>  $validator->errors()->first(),
            ], 400);
        }

        DB::beginTransaction();
        try
        {
            $category->category_name =  $request->input("category_name");
            $category->is_active     =  $request->input("is_active", 1);
            $category->save();
            DB::commit();

            return response()->json([
                "success" => true,
                "message" => "Category updated",
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ], 500);
        }   
    }

    public function addCategory(Request $request)
    {
        $validator = $this->categoryValidator($request->all());
        if($validator->fails())
        {
            return response()->json([
                "success" =>  false,
                "message" =>  $validator->errors()->first(),
            ], 400);
        }

        DB::beginTransaction();
        try
        {
            $category = new Category();
            $category->category_name = $request->input("category_name");
            $category->is_active = $request->input("is_active", 1);
            $category->save();

            DB::commit();
            return response()->json([
                "success" => true,
                "message" => "Categroy Added",
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return resposne()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    public function deleteCategory(string $id)
    {
        $category = Category::find($id);
        if(empty($category))
        {
            return response()->json([
                "success" => false,
                "message" => "Category not found",
            ]);
        }

        DB::beginTransaction();
        try
        {
            $category->delete();
            DB::commit();
            return response()->json([
                "success" => true,
                "message" => "Category deleted",
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
