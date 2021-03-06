@extends('layout.dashboard')
@section('page_heading','Admin Request')
@section('section')

    <div class="row">
        <div class="col-sm-8">
            @section ('stable_panel_title','Admin Request Table')
            @section ('stable_panel_body')
                @include('widgets.request', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

    </div>

@stop
