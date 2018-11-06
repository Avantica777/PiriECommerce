@extends('layout.layout')


@section('content')

    <div class="page-container">
        <div class="container">
            <div class="col-md-3 col-sm-3 col-xs-6 text-center">
                <a href="{{url('buyers')}}"><img src="{{url('assets/image/icons/members.png')}}" class="icon_hover margin-bottom-5"></a>
                <p><strong>Buyers</strong></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 text-center">
                <a href="{{url('allproducts')}}"><img src="{{url('assets/image/icons/product.png')}}" class="icon_hover margin-bottom-5"></a>
                <p><strong>All Products</strong></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 text-center">
                <a href="{{url('year')}}"><img src="{{url('assets/image/icons/transaction.png')}}" class="icon_hover margin-bottom-5"></a>
                <p><strong>Transaction History</strong></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 text-center">
                <a href="{{url('categories')}}"><img src="{{url('assets/image/icons/category.png')}}" class="icon_hover margin-bottom-5"></a>
                <p><strong>Categories</strong></p>
            </div>
        </div>
    </div>

@stop

