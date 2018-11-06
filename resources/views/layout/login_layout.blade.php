<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Piri Commerce</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/stylesheets/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    @yield('style')
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{asset('assets/stylesheets/components-md.css')}}" id="style_components" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/stylesheets/plugins-md.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/layout.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{asset('assets/stylesheets/custom.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="{{url('favicon.ico')}}"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
    <h3 class="signin_title">Piri Commerce</h3>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    @yield('content')
</div>
<div class="copyright hide">
    2018 © Piri Commerce.
</div>

<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{asset('assets/scripts/respond.min.js')}}"></script>
<script src="{{asset('assets/scripts/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{asset('assets/scripts/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/jquery.cokie.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('script')
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/demo.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/scripts/login.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
        Demo.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>