<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedbacks;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FeedbacksController extends Controller
{
    public function index()
    {
        $user_feedbacks  =   Feedbacks::getFeedbacks();
        return view("admin.feedbacks_page", compact("user_feedbacks"));
    }

    public function toggle(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "feedback_id"   =>  "required|integer",
        ]);

        if($validator->fails())
        {
            return response()->json(["message" =>  $validator->errors()], 400);
        }

        $feedback   =   Feedbacks::find($request->feedback_id);
        if(empty($feedback))
        {
            return response()->json(["message"   =>  "Feedback not found"], 404);
        }

        DB::beginTransaction();
        try
        {
            $feedback->is_displayed = $feedback->is_displayed == 0 ? 1 : 0;
            $feedback->save();
            DB::commit();
            $message    =   $feedback->is_displayed == 1 ? "displayed" : "hidden";
            return response()->json(["message" => "Feeedback $message"], 200);
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
            return response()->json(["message" => "Internal server error"], 500);
        } 
    }


    public function viewDetails(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "feedback_id"   =>  "required|integer|exists:feedbacks,id"
        ]);

        if($validator->fails())
        {
            return response()->json(["message" =>  $validator->errors()], 400);
        }

        $feedback   =   Feedbacks::join("users", "users.id", "=", "feedbacks.user_id")
                                ->where("feedbacks.id", $request->feedback_id)
                                ->select("feedbacks.*", "users.name as user_name")
                                ->first();
        return response()->json([
            "data"  =>  $feedback->toArray()
        ],200);
    }

    public function delete(Request $request)
    {
        $validator  =   Validator::make($request->all(),[
            "id"   =>  "required|integer|exists:feedbacks,id"
        ]);
        if($validator->fails())
        {
            return redirect()->route("user.feedbacks")->with("error", "Please provide correct id.");
        }
        $feedback   =   Feedbacks::find($request->id);
        $feedback->delete();
        return redirect()->route("user.feedbacks")->with("success", "Feedback deleted");
    }
}
