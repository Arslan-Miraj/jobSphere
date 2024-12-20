<?php

namespace App\Http\Controllers;

use App\Models\Job_type;
use App\Models\Job_category;
use App\Models\Post_job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index(Request $request){
        $categories = Job_category::where('deleted', 0)->get();
        $job_types = Job_type::where('deleted', 0)->get();
        $latest_jobs = Post_job::where('deleted', 0);

        // Keyword Filter
        if(!empty($request->keyword)){
            $latest_jobs = $latest_jobs->where(function($query) use ($request) {
                $query->orWhere('title', 'like', '%' . $request->keyword . '%');
                $query->orWhere('keywords', 'like', '%' . $request->keyword . '%');
            });            
        }

        // Location Filter
        if(!empty($request->location)){
            $latest_jobs = $latest_jobs->where('location', $request->location);
        }

        // Category Filter
        if(!empty($request->category)){
            $latest_jobs = $latest_jobs->where('category_id', $request->category);
        }

        // Job Type Filter
        $jobTypeArray = [];
        if(!empty($request->jobType)){
            $jobTypeArray = explode(',', $request->jobType);
            $latest_jobs = $latest_jobs->whereIn('job_type_id', $jobTypeArray);
        }

        // Experience Filter
        if(!empty($request->experience)){
            $latest_jobs = $latest_jobs->where('experience', $request->experience);
        }

        $latest_jobs = $latest_jobs->with('jobType');
        if ($request->sort == '0'){
            $latest_jobs = $latest_jobs->orderBy('created_at', 'ASC');
        } else{
            $latest_jobs = $latest_jobs->orderBy('created_at', 'DESC');
        }

        $latest_jobs = $latest_jobs->paginate(6);
        return view('frontend.job.jobs', compact('latest_jobs', 'categories', 'job_types', 'jobTypeArray'));
    }
}
