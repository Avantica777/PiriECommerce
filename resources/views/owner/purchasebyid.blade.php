@extends('layout.dashboard')
@section('page_heading','Purchase Of Each Product By ID')
@section('section')

    <div class="row">
        <div class="col-sm-12">
            @section ('stable_panel_title','Purchase Of Each Product By ID')
            @section ('stable_panel_body')
                @include('widgets.byid', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

    </div>

@stop