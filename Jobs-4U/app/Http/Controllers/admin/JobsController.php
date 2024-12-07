<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\user\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::join("users", "users.id", "=", "jobs.user_id")
                ->select("jobs.*", "users.name as employer")
                ->get();
        return view("admin.jobs", compact("jobs"));
    }
}
