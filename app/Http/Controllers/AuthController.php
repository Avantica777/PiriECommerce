<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function buyerRegister(Request $request)
    {
        $rules = array(
            'email' => 'required|unique:users,email|email', // make sure the email is an actual email
            'buyer_password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('signin/brr');
        } else {
            $email = $request['email'];
            $password = bcrypt($request['buyer_password']);
            $password_hint = $request['buyer_password'];

            $user = new User();
            $user->email = $email;
            $user->password = $password;
            $user->password_hint = $password_hint;
            $user->role = "user";
            $user->approve = "approved";


            $user->save();

            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $country = $request['country'];

            $userprofile = new User_profile();
            $userprofile->firstname = $firstname;
            $userprofile->lastname = $lastname;
            $userprofile->country = $country;
            $userprofile->user_id = $user->id;


            $picture = $request->file('picture');
            $destinationPath = 'uploads';
            $picture->move($destinationPath, $picture->getClientOriginalName());
            $userprofile->profile_picture = $picture->getClientOriginalName();

            $userprofile->save();
            return view('buyertype',['email'=>$email,'password'=>$password_hint]);

        }

    }

    public function adminRegister(Request $request)
    {
        $rules = array(
            'email' => 'required|unique:users,email|email', // make sure the email is an actual email
            'admin_password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('signin/amr');
        } else {
            $email = $request['email'];
            $password = bcrypt($request['admin_password']);
            $password_hint = $request['admin_password'];

            $user = new User();
            $user->email = $email;
            $user->password = $password;
            $user->password_hint = $password_hint;
            $user->role = "admin";
            $user->approve = "request";

            $user->save();

            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $country = $request['country'];

            $userprofile = new User_profile();
            $userprofile->firstname = $firstname;
            $userprofile->lastname = $lastname;
            $userprofile->country = $country;
            $userprofile->user_id = $user->id;


            $picture = $request->file('picture');
            $destinationPath = 'uploads';
            $picture->move($destinationPath, $picture->getClientOriginalName());
            $userprofile->profile_picture = $picture->getClientOriginalName();

            $userprofile->save();
            return Redirect::to('signin/lgin')->with(['wait' => 'until to accept']);
        }
    }

    public function login(){

        
        $this->middleware('auth');

        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('signin/lgin')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            $_diff = Input::get('user_timezone');

            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );

            // attempt to do the login
            if (Auth::Attempt($userdata)) {
                $profile = User_profile::where('user_id', Auth::user()['id'])->get();
                $user_fullname = $profile[0]['firstname'] . " " . $profile[0]['lastname'];
                $user_picture = $profile[0]['profile_picture'];
                Auth::user()->fullname = $user_fullname;
                Auth::user()->picture = $user_picture;
                Session::put('currentUser', Auth::user());
                Session::put('user_timezone', $_diff);
                if (Auth::user()->role == 'owner'){
                    return Redirect::to('owner');
                }elseif (Auth::user()->role == 'admin'){
                    if (Auth::user()->approve == 'approved'){
                        return Redirect::to('admin');
                    }elseif (Auth::user()->approve == 'request'){
                        Session::put('approve','request');
                        return Redirect::to('signin/lgin')->with(['wait' => 'until to accept']);
                    }

                }elseif (Auth::user()->role == 'user'){
                    return Redirect::to('buyer');
                }



            } else {
                // validation not successful, send back to form
                return Redirect::to('signin/lgin')->with(['login_fail' => 'wrong password']);

            }

        }

    }

    public function buyerLogin(Request $request){
        $userdata = array(
            'email' => $request['email'],
            'password' => $request['password']
        );

        $_diff = Input::get('user_timezone');
        // attempt to do the login
        if (Auth::Attempt($userdata)) {
            $profile = User_profile::where('user_id', Auth::user()['id'])->get();
            $user_fullname = $profile[0]['firstname'] . " " . $profile[0]['lastname'];
            $user_picture = $profile[0]['profile_picture'];
            Auth::user()->fullname = $user_fullname;
            Auth::user()->picture = $user_picture;
            Session::put('currentUser', Auth::user());
            Session::put('user_timezone', $_diff);
            if (Auth::user()->role == 'owner'){
                return Redirect::to('owner');
            }elseif (Auth::user()->role == 'user'){
                $type = Input::get('type');
                User_profile::where('user_id',Auth::user()->id)->update(['type'=>$type]);
                return Redirect::to('buyer');
            }

        }else{
            // validation not successful, send back to form
            return Redirect::to('signin/lgin');
        }
    }
    
    public function logout(){
        // Auth::logout();
        // Session::remove('currentUser');
        // Session::remove('user_timezone');
        // Session::remove('approve');
        return Redirect::to('/')->with(['success' => 'success']);
    }
}
