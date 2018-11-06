@extends('layout.dashboard')
@section('page_heading','Super Admin')
@section('section')

    <div class="row">
        <div class="col-sm-6">
            @section ('stable_panel_title','Super Admin Table')
            @section ('stable_panel_body')
                @include('widgets.ownerwidget', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

    </div>

@stop
