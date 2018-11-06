@extends('layout.dashboard')
@section('page_heading','Sub Categories')
@section('section')

    <div class="row">
        <div class="col-sm-8">
            @section ('stable_panel_title','Sub Categories')
            @section ('stable_panel_body')
                @include('widgets.owner_subcategories', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

        <div class="col-sm-4">
            <a href="{{url('owner/addsubcategorypage/'.$category_id)}}" class="btn btn-primary btn-outline    btn-xs   ">Add Sub Category</a>
        </div>
    </div>

@stop