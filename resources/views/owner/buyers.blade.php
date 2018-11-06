@extends('layout.dashboard')
@section('page_heading','Buyers')
@section('section')

    <div class="row">
        <div class="col-sm-8">
            @section ('stable_panel_title','Buyers Table')
            @section ('stable_panel_body')
                @include('widgets.owner_buyers', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

    </div>

@stop
