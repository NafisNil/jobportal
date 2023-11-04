<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SeekerRegistrationRequest;
use Auth;
class UserController extends Controller
{
    //
    const  JOB_SEEKER = "seeker";
    const  JOB_POSTER = "employer";
    public function createSeeker(){
        return view('user.seeker-register');
    }

    public function createEmployer(){
        return view('user.employer-register');
    }
    public function storeSeeker(SeekerRegistrationRequest $request){

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' =>bcrypt( request('password')),
            'user_type' => self::JOB_SEEKER
        ]);

        Auth::login($user);
        $user->sendEmailVerificationNotification();
        return response()->json('success');
     //   return redirect()->route('login')->with('successMessage', 'Your account was created!');
    }

    public function storeEmployer(SeekerRegistrationRequest $request){

       $user =  User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' =>bcrypt( request('password')),
            'user_type' => self::JOB_POSTER,
            'user_trial' => now()->addWeek()
        ]);
        Auth::login($user);
        $user->sendEmailVerificationNotification();
        return response()->json('success');
       // return redirect()->route('login')->with('successMessage', 'Your account was created!');
    }
    public function login(){
        return view('user.login');
    }

    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended('dashboard');
        }

        return "Wrong email or password";
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }

    public function profile(){
            return view('profile.index');
    }

    public function update(Request $request){
        if ($request->hasFile('profile_pic')) {
            # code...
             $imagepath = $request->file('profile_pic')->store('profile', 'public');
            User::find(auth()->user()->id)->update(['profile_pic' => $imagepath]);
        }
        User::find(auth()->user()->id)->update($request->except('profile_pic'));
        return back()->with('success', 'Your profile has been updated!');
    }
}
