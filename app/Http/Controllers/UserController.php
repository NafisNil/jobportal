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
            if (auth()->user()->user_type == "employer") {
                # code...
                return redirect()->to('dashboard');
            }else{
                return redirect()->to('/');
            }
         
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

    public function seekerProfile(){
        return view('seeker.profile');
    }

    public function changePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = auth()->user();
        if (!Hash::check($request->current_passowrd, $user->password)) {
            # code...
            return back()->with('error', 'current password does not match!');
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Your password has been changed successfully! ');
    }

    public function uploadResume(Request $request){
        $this->validate($request, [
            'resume' => 'required|mimes:pdf,docx,doc',
         
        ]);
        if ($request->hasFile('resume')) {
            # code...
             $resume = $request->file('resume')->store('resume', 'public');
            User::find(auth()->user()->id)->update(['resume' => $resume]);

            return back()->with('success', 'Your resume has been updated!');
        }
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
