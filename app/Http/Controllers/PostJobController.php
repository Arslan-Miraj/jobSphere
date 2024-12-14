<?php

namespace App\Http\Controllers;

use App\Models\Post_job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostJobController extends Controller
{
    public function index(){
        $categories = DB::table('job_categories')->get()->where('deleted', 0);
        $job_types = DB::table('job_types')->get()->where('deleted', 0);
        return view('frontend.job.post_job', compact('categories', 'job_types'));
    }


    public function saveJobs(Request $request){
        $validation = Validator::make($request->all(),[
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'job' => 'required',
            'vacancy' => 'required|integer',
            'experience' => 'required',
            'description' => 'required',
            'company_name' => 'required|max:75',
        ]);

        if($validation->passes()){
            $post_job = new Post_job();

            $post_job->user_id = Auth::user()->id;
            $post_job->title = $request->title;
            $post_job->category_id = $request->category;
            $post_job->job_type_id = $request->job;
            $post_job->vacancy = $request->vacancy;
            $post_job->experience = $request->experience;
            $post_job->salary = $request->salary;
            $post_job->location = $request->location;
            $post_job->description = $request->description;
            $post_job->benefits = $request->benefits;
            $post_job->resposibilities = $request->responsibility;
            $post_job->qualifications = $request->qualifications;
            $post_job->keywords = $request->keywords;
            $post_job->company_name = $request->company_name;
            $post_job->company_location = $request->company_location;
            $post_job->company_website = $request->website;
            $post_job->save();
            session()->flash('success', 'Job is posted successfully');
            return response()->json([
                'status' => true,
                'error' => []
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }
    }


    public function showJobs($id){
        $user_id = Auth::user()->id;

        $categories = DB::table('job_categories')->get()->where('deleted', 0);
        $job_types = DB::table('job_types')->get()->where('deleted', 0);

        $job = Post_job::where([
            'user_id' => $user_id, 
            'id' => $id
        ])->first();
        // dd($job);
        if($job == null){
            abort(404);
        }

        return view('frontend.job.edit_job', compact('categories', 'job_types', 'job'));
    }

    public function editJobs(Request $request, $id){
        $validation = Validator::make($request->all(),[
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'job' => 'required',
            'vacancy' => 'required|integer',
            'experience' => 'required',
            'description' => 'required',
            'company_name' => 'required|max:75',
        ]);

        if($validation->passes()){
            $post_job = Post_job::find($id);

            $post_job->user_id = Auth::user()->id;
            $post_job->title = $request->title;
            $post_job->category_id = $request->category;
            $post_job->job_type_id = $request->job;
            $post_job->vacancy = $request->vacancy;
            $post_job->experience = $request->experience;
            $post_job->salary = $request->salary;
            $post_job->location = $request->location;
            $post_job->description = $request->description;
            $post_job->benefits = $request->benefits;
            $post_job->resposibilities = $request->responsibility;
            $post_job->qualifications = $request->qualifications;
            $post_job->keywords = $request->keywords;
            $post_job->company_name = $request->company_name;
            $post_job->company_location = $request->company_location;
            $post_job->company_website = $request->website;
            $post_job->save();
            session()->flash('success', 'Job updated successfully');
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }
    }

    public function myJobs(){
        // Two ways to get user id 1 => write Auth::user()->id in where condition
        // jobType is a method making relation in Post_job model
        $id = Auth::user()->id;
        $jobs = Post_job::where('user_id', $id)->with('jobType')->orderBy('created_at', 'DESC')->paginate(5);
        return view('frontend.job.my_jobs', compact('jobs'));
    }

    public function deleteJob(Request $request){

        $job = Post_job::where([
            'id' => $request->jobId,
            'user_id' => Auth::user()->id
        ])->first();

        if($job == null){
            session()->flash('error', 'Either job deleted or not found');
            return response()->json([
                'status' => true,
            ]);
        }
        
        Post_job::where('id', $request->jobId)->delete();
        session()->flash('success', 'Job deleted successfully');
        return response()->json([
            'status' => true,
            ]);
        // return to_route('my_jobs')->with('error', 'Job deleted successfully');
    }
}
