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
class PostJobController extends Controller
{
    //
    protected $job;
    public function __construct(JobPost $job){
        $this->job = $job;
    }
    public  function create(){
        return view('job.create');
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
}
