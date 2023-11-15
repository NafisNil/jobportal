<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;
use DB;
class ApplicantController extends Controller
{
    //
    public function index(){
        $listings = Listing::latest()->withCount('users')->where('user_id', auth()->user()->id)->get();
       return view('applicants.index', compact('listings'));
    }

    public function show(Listing $listing){
        $listings = Listing::with('users')->where('slug', $listing->slug)->first();
        return view('applicants.show', compact('listings'));
    }
}
