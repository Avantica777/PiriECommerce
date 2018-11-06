@extends('layout.dashboard')
@section('page_heading','Purchase Of All Products By This Month')
@section('section')

    <div class="row">
        <div class="col-sm-8">
            @section ('stable_panel_title','Purchase Of All Products By This Month')
            @section ('stable_panel_body')
                @include('widgets.eachmonth', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

    </div>

@stop