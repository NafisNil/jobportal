<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
class JoblistingController extends Controller
{
    //
    public function index(){
        $jobs = Listing::get();
        return view('home', compact('jobs'));
    }
}
