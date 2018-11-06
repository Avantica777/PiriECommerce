@extends('layout.dashboard')
@section('page_heading','Products')
@section('section')

    <div class="row">
        <div class="col-sm-8">
            @section ('stable_panel_title','Products')
            @section ('stable_panel_body')
                @include('widgets.owner_products', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

        <div class="col-sm-4">
            <a href="{{url('owner/addproductpage/'.$sub_category_id)}}" class="btn btn-primary btn-outline    btn-xs   ">Add Product</a>
        </div>

    </div>

@stop