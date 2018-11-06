<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Piri Commerce</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Mali:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>

    <link href="{{asset('assets/stylesheets/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://einsteintoolkit.org/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://einsteintoolkit.org/css/etk.css" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/stylesheets/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/style-responsive.css')}}" rel="stylesheet" type="text/css"/>

    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE STYLES -->
@yield('style')
<!-- END PAGE STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="{{asset('assets/stylesheets/components.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/components-md.css')}}" id="style_components" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/stylesheets/plugins-md.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/layout.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/light.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{asset('assets/stylesheets/custom.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="{{url('favicon.ico')}}"/>

    <script src="{{asset('assets/scripts/jquery.min.js')}}" type="text/javascript"></script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-md page-header-fixed" style = "overflow-x: hidden !important; overflow-y: auto;" id="body_bg">
<!-- BEGIN HEADER -->
<div class="header">
    <div class="container">
        @if(Auth::user())
            @if(Session::get('currentUser')->role == 'user')
                <!-- <a class="site-logo logo_a" href="{{url('buyer')}}"> -->
                    <!-- <img src="{{url('assets/image/logo.png')}}" alt="piri commerce" class="logo_img"> -->
                <!-- </a> -->
                <a class="site-logo margin-right-0" href="{{url('/')}}">
                    <img src="{{url('assets/image/title.png')}}" alt="piri commerce" class="logo_title_img">
                </a>
            @elseif(Session::get('currentUser')->role == 'admin')
                @if(Session::has('approve'))
                    <!-- <a class="site-logo logo_a" href="{{url('signin')}}"> -->
                        <!-- <img src="{{url('assets/image/logo.png')}}" alt="piri commerce" class="logo_img"> -->
                    <!-- </a> -->
                    <a class="site-logo margin-right-0" href="{{url('/')}}">
                        <img src="{{url('assets/image/title.png')}}" alt="piri commerce" class="logo_title_img">
                    </a>
                @else
                    <!-- <a class="site-logo logo_a" href="{{url('admin')}}"> -->
                        <!-- <img src="{{url('assets/image/logo.png')}}" alt="piri commerce" class="logo_img"> -->
                    <!-- </a> -->
                    <a class="site-logo margin-right-0" href="{{url('/')}}">
                        <img src="{{url('assets/image/title.png')}}" alt="piri commerce" class="logo_title_img">
                    </a>
                @endif
            @elseif(Session::get('currentUser')->role == 'owner')
                <!-- <a class="site-logo logo_a" href="{{url('owner')}}"> -->
                    <!-- <img src="{{url('assets/image/logo.png')}}" alt="piri commerce" class="logo_img"> -->
                <!-- </a> -->
                <a class="site-logo margin-right-0" href="{{url('/')}}">
                    <img src="{{url('assets/image/title.png')}}" alt="piri commerce" class="logo_title_img">
                </a>
            @endif
        @else
            <!-- <a class="site-logo logo_a" href="{{url('signin')}}"> -->
                <!-- <img src="{{url('assets/image/logo.png')}}" alt="piri commerce" class="logo_img"> -->
            <!-- </a> -->
            <a class="site-logo margin-right-0" href="{{url('/')}}">
                <img src="{{url('assets/image/title.png')}}" alt="piri commerce" class="logo_title_img">
            </a>
        @endif

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
            <ul>
                @if(Auth::user())
                    @if(Auth::user()->approve == 'approved')
                        <li class="avatar-list-padding">
                            <img alt="" class="img-circle avatar-size"
                                 src="{{url('uploads/'.Session::get('currentUser')->picture)}}"/>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="{{url('userprofile/'.Session::get('currentUser')->email)}}">
                                <strong>{{Session::get('currentUser')->fullname}}</strong>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-toggle" href="{{url('logout')}}">
                                <strong>Log Out</strong>&nbsp<i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    @elseif(Auth::user()->approve == 'request')
                        <li>
                            <a class="dropdown-toggle" data-toggle="modal" href="{{url('signin/lgin')}}">
                                <strong>Log In</strong>&nbsp<i class="fa fa-sign-in"></i>
                            </a>
                        </li>
                    @endif
                @else
                    <li>
                        <a class="dropdown-toggle" data-toggle="modal" href="{{url('signin/lgin')}}">
                            <strong>Log In</strong>&nbsp<i class="fa fa-sign-in"></i>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-toggle" data-toggle="modal" href="{{url('signin/amr')}}">
                            <strong>Admin Register</strong>&nbsp<i class="fa fa-user-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-toggle" data-toggle="modal" href="{{url('signin/brr')}}">
                            <strong>Buyer Register</strong>&nbsp<i class="fa fa-user-plus"></i>
                        </a>
                    </li>
            @endif
            <!-- END TOP SEARCH -->
            </ul>
        </div>
        <!-- END NAVIGATION -->
    </div>
</div>


<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- <img class="img-responsive margin-auto" src="{{url('assets/image/logo.png')}}"> -->
            <h1 class = "glow">
                PiriCommerce 
            </h1>
        </div>
    </div>
</div>
@yield('content')
<!-- END CONTAINER -->
<div class="pre-footer">
    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <!-- <img src="{{url('assets/image/dashboard_footer.png')}}" class="prefooter_img"/> -->
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="scroll-to-top">
        <i class="fa fa-arrow-circle-up"></i>
    </div>
</div>
<div class="footer footer-height">
    <div class="row pull-left margin-left-20">
            2018 © Piri Commerce &nbsp;&nbsp;<a href="{{url('contact_us')}}">Contact Us</a> | <a href="{{url('about_me')}}"  class="margin-right-20">About Me</a>
            <a href="javascript:;" class="margin-right-10"><i class="fa fa-facebook"></i></a>
            <a href="javascript:;" class="margin-right-10"><i class="fa fa-twitter"></i></a>
            <a href="javascript:;"><i class="fa fa-instagram"></i></a>
        <!-- END PAYMENTS -->
    </div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->

<!--[if lt IE 9]>
<script src="{{asset('assets/scripts/respond.min.js')}}"></script>
<script src="{{asset('assets/scripts/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{asset('assets/scripts/jquery-migrate.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/scripts/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/jquery.cokie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/bootstrap-switch.min.js')}}" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
@yield('script')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/layout_frontend.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/demo.js')}}" type="text/javascript"></script>


<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init();
    });
</script>

<style>
    .glow {
        font-size: 8vw;
        color: #fff;
        text-align: center;
        -webkit-animation: glow 1s ease-in-out infinite alternate;
        -moz-animation: glow 1s ease-in-out infinite alternate;
        animation: glow 1s ease-in-out infinite alternate;
    }

    @-webkit-keyframes glow {
        from {
            text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
        }
        to {
            text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
        }
    }
</style>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>