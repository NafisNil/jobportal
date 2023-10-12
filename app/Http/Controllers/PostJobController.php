<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Middleware\isEmployer;
use App\Http\Middleware\isPremiumUser;
use App\Mail\PurchaseMail;
use App\Http\Middleware\donotAllowUserToMakePayment;
use App\Models\User;
class PostJobController extends Controller
{
    //
    public  function create(){
        return view('job.create');
    }
}
