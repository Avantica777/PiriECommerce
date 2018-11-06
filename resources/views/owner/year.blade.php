@extends('layout.dashboard')
@section('page_heading','By years')
@section('section')

    <div class="row">
        <div class="col-sm-6">
            @section ('stable_panel_title','Years Table')
            @section ('stable_panel_body')
                @include('widgets.owner_years', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

    </div>
            
@stop
