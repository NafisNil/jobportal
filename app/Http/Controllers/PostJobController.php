<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Middleware\isEmployer;
use App\Http\Middleware\isPremiumUser;
use App\Mail\PurchaseMail;
use App\Post\JobPost;
use App\Http\Middleware\donotAllowUserToMakePayment;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Support\Str;
use App\Http\Requests\JobPostFormRequest;
use App\Http\Requests\JobEditFormRequest;
class PostJobController extends Controller
{
    //
    protected $job;
    public function __construct(JobPost $job){
        $this->job = $job;
        $this->middleware('auth');
    }
    public  function create(){
        return view('job.create');
    }

    public function index(){
        $jobs = Listing::where('user_id', auth()->user()->id)->get();
        return view('job.index', compact('jobs'));
    }

    public function store(Request $request){
 
        $this->job->store($request);
  /*    $this->validate($request, [
                'title' => 'required|min:5',
                'feature_image' => 'required|mimes:jpg,png,jpeg,svg,webp|max:2048',
                'description' => 'required',
                'roles' => 'required',
                'job_types' => 'required',
                'address' => 'required',
                'date' => 'required',
                'salary' => 'required'
            ]);*/

        
            return back();
    }

    public function edit(Listing $listing){

        return view('job.edit', compact('listing'));
    }

    public function update($id, Request $request){
       $this->job->updatePost($id, $request);

        return back()->with('success', 'Your post job have been successfully updated!');
    }
}
