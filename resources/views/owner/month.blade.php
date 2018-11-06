@extends('layout.dashboard')
@section('page_heading','By Months')
@section('section')

    <div class="row">
        <div class="col-sm-6">
            @section ('stable_panel_title','Months Table')
            @section ('stable_panel_body')
                @include('widgets.owner_months', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

    </div>
            
@stop
