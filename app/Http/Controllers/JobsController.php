<?php

namespace App\Http\Controllers;

use App\Models\Job_type;
use App\Models\Job_category;
use App\Models\Post_job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index(){
        $categories = Job_category::where('deleted', 0)->get();
        $job_types = Job_type::where('deleted', 0)->get();
        $latest_jobs = Post_job::where('deleted', 0)->with('jobType')->orderBy('created_at', 'DESC')->take(6)->get();
        return view('frontend.job.jobs', compact('latest_jobs', 'categories', 'job_types'));
    }
}
