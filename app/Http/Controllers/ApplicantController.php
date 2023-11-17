<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;
use App\Mail\ShortlistMail;
use DB;
use Illuminate\Support\Facades\Mail;
class ApplicantController extends Controller
{
    //
    public function index(){
        $listings = Listing::latest()->withCount('users')->where('user_id', auth()->user()->id)->get();
       return view('applicants.index', compact('listings'));
    }

    public function show(Listing $listing){
        $this->authorize('view', $listing);
        $listings = Listing::with('users')->where('slug', $listing->slug)->first();
        return view('applicants.show', compact('listings'));
    }

    public function shortlist($listingId, $userId){
        $listing = Listing::find($listingId);
        $user = User::find($userId);
        if ($listing) {
            # code...
            $listing->users()->updateExistingPivot($userId, ['shortlisted' => true]);
            Mail::to($user->email)->send(new ShortlistMail($user->name, $listing->title));
            return back()->with('success', 'User is shortlisted successfully!');
        }

        return back();
    }
}
