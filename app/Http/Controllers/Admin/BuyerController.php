<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\User_profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BuyerController extends Controller
{
    //Buyers Info
    public function getBuyers(){
        $_diff = Session::get('user_timezone')*60;
        $users = User::where('role', 'user')->get();
        foreach ($users as $user){
            $profile = User_profile::where('user_id', $user['id'])->get();
            $fullname = $profile[0]['firstname']." ".$profile[0]['lastname'];
            $user['fullname'] = $fullname;
            $user['gender'] = $profile[0]['gender'];
            $user['country'] = $profile[0]['country'];
            $user['picture'] = $profile[0]['profile_picture'];
            $user['registered_at'] = date('Y-m-d g:i A',strtotime($user['created_at'])-$_diff);
        }

        return view('admin/buyers/buyers', ['users'=>$users]);
    }

    public function removeBuyer($user_id){
        User::where('id', $user_id)->delete();
        User_profile::where('user_id', $user_id)->delete();
//        $postIDs = Travel_post::where('userID',$userID)->select('id')->get();
//
//        foreach ($postIDs as $postID){
//            Travel_post::where('id',$postID['id'])->delete();
//        }
        return Redirect::to('buyers');
    }

    public function getUserProfile($user_email){
        $user = User::where('email',$user_email)->get();
        // echo $user[0]['id'];
        $profile = User_profile::where('user_id',$user[0]['id'])->get();

        $res['firstname'] = $profile[0]['firstname'];
        $res['lastname'] = $profile[0]['lastname'];
        $res['country'] = $profile[0]['country'];
        $res['profile_picture'] = $profile[0]['profile_picture'];
        $res['password_hint'] = $user[0]['password_hint'];
        
        return view('userprofile', ['users'=>$res]);
    }
}
