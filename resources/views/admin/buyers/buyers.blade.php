@extends('layout.layout')
@section('style')
    <link href="http://fonts.googleapis.com/css?family=Quicksand:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/stylesheets/select2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/dataTables.scroller.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>

@stop
@section('content')

    <h3 class="tag_title">Buyers</h3>
    <div class="container">
        <div class="portlet box table-header-blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-users" style="color: white;"></i>Buyers
                </div>
            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover" id="sample_6">

                    <thead class="thead-color">
                    <tr>
                        <th>
                            Buyer
                        </th>
                        <th>
                            Buyer Name
                        </th>
                        <th>
                            E-mail
                        </th>
                        <th>
                            Pasword
                        </th>
                        <th>
                            Gender
                        </th>
                        <th>
                            Country
                        </th>
                        <th>
                            Registered Date
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)

                        <tr>
                            <td><img src="{{url('uploads/'.$user['picture'])}}" class="img-circle table_img"></td>
                            <td>{{$user['fullname']}}</td>
                            <td>{{$user['email']}}</td>
                            <td>{{$user['password_hint']}}</td>
                            <td>{{$user['gender']}}</td>
                            <td>{{$user['country']}}</td>
                            <td>{{$user['registered_at']}}</td>
                            <td><a class="btn btn-primary btn-outline btn-xs remove_btn" href="{{url('removebuyer/'.$user['id'])}}" >Remove</a></td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script src="{{asset('assets/scripts/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/dataTables.scroller.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/dataTables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/table-advanced.js')}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            TableAdvanced.init();

            function reallySure(){
                var message = 'Are you sure about that?';
                action = confirm(message) ? true : event.preventDefault();
                console.log("what's going on?");
            }

            var aElems = document.getElementsByClassName('remove_btn');

            for (var i = 0, len = aElems.length; i < len; i++) {
                aElems[i].addEventListener('click', reallySure);
            }
        });
    </script>
@stop