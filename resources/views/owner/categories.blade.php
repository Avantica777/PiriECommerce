@extends('layout.dashboard')
@section('page_heading','Categories')
@section('section')

    <div class="row">
        <div class="col-sm-8">
            @section ('stable_panel_title','Categories')
            @section ('stable_panel_body')
                @include('widgets.owner_categories', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

        <div class="col-sm-4">
            <a href="{{url('owner/addcategorypage')}}" class="btn btn-primary btn-outline    btn-xs   ">Add Category</a>
        </div>

    </div>

@stop