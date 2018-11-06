@extends('layout.login_layout')
@section('style')
    <link href="{{asset('assets/stylesheets/login2.css')}}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="{{url('buyerlogin')}}" method="post">
        <input type="hidden" name="_token" value={{csrf_token()}}>
        <div class="form-title">
            <span class="form-title">Welcome.</span>
            <span class="form-subtitle">Please login.</span>
        </div>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>
			Enter any username and password. </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">E-mail</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="E-mail" name="email" value="{{$email}}"/>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" value="{{$password}}"/>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Buyer Type</label>
            <select name="type" class="form-control">
                <option value="Company">Company</option>
                <option value="Individual">Individual</option>

            </select>
        </div>
        <div class="form-group">
            <input id="buyer_timezone_register" class="form-control" type="hidden"
                   name="user_timezone"
                   autocomplete="off" value=""/>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-block uppercase" onclick="getRegisterTimezone()">Continue</button>
        </div>


    </form>
    <!-- END REGISTRATION FORM -->
@stop
@section('script')
    <script src="{{asset('assets/scripts/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script>
        function getRegisterTimezone() {
            var _date = new Date();
            var _diff = _date.getTimezoneOffset();
            document.getElementById("buyer_timezone_register").value = _diff;
        }

    </script>
@stop