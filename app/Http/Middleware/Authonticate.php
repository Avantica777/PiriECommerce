<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Authonticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Session::get('currentUser');
        if($user!=null){
            if ($user->role == 'owner'){
                return true;
            }elseif ($user->role == 'admin'){
                if ($user->approve == 'approved'){
                    return true;
                }elseif ($user->approve == 'request'){
                    return Redirect::to('signin')->with(['wait' => 'until to accept']);
                }
    
            }elseif ($user->role == 'user'){
                return true;
            }
        }
        return false;
    }
}
