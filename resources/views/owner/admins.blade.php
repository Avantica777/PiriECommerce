@extends('layout.dashboard')
@section('page_heading','Admins')
@section('section')

    <div class="row">
        <div class="col-sm-8">
            @section ('stable_panel_title','Admins Table')
            @section ('stable_panel_body')
                @include('widgets.owner_admins', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

    </div>

@stop
