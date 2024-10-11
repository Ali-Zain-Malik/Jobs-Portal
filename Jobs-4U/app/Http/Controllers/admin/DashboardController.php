<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\User;
use App\Models\user\Job;
use App\Models\Feedbacks;


class DashboardController extends Controller
{
    public function index()
    {
        $total_users        =   User::count();
        $employers          =   User::where("role", "employer")->count();
        $applicants         =   User::where("role", "applicant")->count();
        $admins             =   User::where("role", "admin")->count();
        $total_jobs         =   Job::count();
        $active_jobs        =   Job::where("is_approved", 1)->where("expiry_date", ">=", date("Y-m-d"))->count();
        $inactive_jobs      =   Job::where("is_approved", 0)->where("expiry_date", "<", date("Y-m-d"))->count();
        $expired_jobs       =   Job::where("expiry_date", "<", date("Y-m-d"))->count();
        $feedbacks          =   Feedbacks::count();
        $byDateUsers        =   User::selectRaw("signup_date, COUNT(*) as user_count")
                                    ->groupBy("signup_date")
                                    ->get();
        $byDateJobs         =   Job::selectRaw("created_at, COUNT(*) as job_count")
                                    ->groupBy("created_at")
                                    ->get();
        $user_feedbacks          =   Feedbacks::getFeedbacks();
        $data   =   [
            "total_users"   =>  $total_users,
            "employers"     =>  $employers,
            "applicants"    =>  $applicants,
            "admins"        =>  $admins,
            "total_jobs"    =>  $total_jobs,
            "active_jobs"   =>  $active_jobs,
            "inactive_jobs" =>  $inactive_jobs,
            "expired_jobs"  =>  $expired_jobs,
            "feedbacks"     =>  $feedbacks,
            "byDateUsers"   =>  $byDateUsers,
            "byDateJobs"    =>  $byDateJobs,
            "user_feedbacks"     =>  $user_feedbacks
        ];

        return view("admin.dashboard", $data);
    }
}
