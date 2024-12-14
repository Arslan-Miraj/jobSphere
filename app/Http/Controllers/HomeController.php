<?php

namespace App\Http\Controllers;

use App\Models\Job_category;
use App\Models\Post_job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Load Home Page
    public function index(){
        $job_categories = Job_category::where('deleted', 0)->orderBy('name', 'ASC')->take(8)->get();
        $job_featured = Post_job::where('deleted', 0)->where('is_featured', 1)
                        ->with('jobType')
                        ->orderBy('created_at', 'DESC')
                        ->take(6)->get();
        $latest_job = Post_job::where('deleted', 0)->with('jobType')->orderBy('created_at', 'DESC')->take(6)->get();
        return view('frontend.home', compact('job_categories', 'job_featured', 'latest_job'));
    }
}
