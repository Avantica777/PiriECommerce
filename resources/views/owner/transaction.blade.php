@extends('layout.dashboard')
@section('page_heading','Transactions')
@section('section')

    <div class="row">
        <div class="col-sm-12">
            @section ('stable_panel_title','Transactions')
            @section ('stable_panel_body')
                @include('widgets.transaction', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

    </div>

@stop