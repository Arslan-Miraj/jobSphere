<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Post_job extends Controller
{
    public function index(){
        $categories = DB::table('job_categories')->get()->where('deleted', 0);
        $job_types = DB::table('job_types')->get()->where('deleted', 0);
        return view('frontend.post_job', compact('categories', 'job_types'));
    }


    public function storeJobs(Request $request){
        $validation = Validator::make($request->all(),[
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'experience' => 'required',
            'location' => 'required',
            'description' => 'required',
            'company_name' => 'required|max:75',
        ]);

        if($validation->passes()){

        }
        else{
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }
    }
}
