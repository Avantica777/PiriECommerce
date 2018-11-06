@extends('layout.layout')
@section('style')
    <link href="http://fonts.googleapis.com/css?family=Quicksand:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/stylesheets/select2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/dataTables.scroller.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/rateit.css')}}" rel="stylesheet" type="text/css">
@stop
@section('content')

    <!-- <h3 class="tag_title">All Products</h3> -->
    <div class="container">
        <div class="portlet box table-header-blue">
            <div class="portlet-title">
                <div class="caption">
                    <!-- <i class="fa fa-dashboard" style="color: white;"></i>All Products -->
                </div>
            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover" id="sample_6">

                    <thead class="thead-color">
                    <tr>
                        <th>
                            Picture
                        </th>
                        <th>
                            Product ID
                        </th>
                        <th>
                            Product Name
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            Sub Category
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)

                        @if($product['quantity']<=$product['limit'])
                            <tr style="background: #ffe075">
                                <td><img src="{{url('products/'.$product['picture'])}}" class="table_img"></td>
                                <td><a href="{{url('productdetail/'.$product['id'])}}" class="product-name-color">{{$product['product_id']}}</a></td>
                                <td>{{$product['product_name']}}</td>
                                <td>{{$product['category']}}</td>
                                <td>{{$product['subcategory']}}</td>
                                <td>{{$product['price']}} $</td>
                                <td>{{$product['quantity']}}<i class="fa fa-warning pull-right" style="color: #ff8850"></i></td>
                                <td><a href="{{url('removeoneproduct/'.$product['id'])}}" class="btn btn-primary btn-outline btn-xs remove_btn">Remove</a></td>
                            </tr>
                        @else
                            <tr>
                                <td><img src="{{url('products/'.$product['picture'])}}" class="table_img"></td>
                                <td><a href="{{url('productdetail/'.$product['id'])}}" class="product-name-color">{{$product['product_id']}}</a></td>
                                <td>{{$product['product_name']}}</td>
                                <td>{{$product['category']}}</td>
                                <td>{{$product['subcategory']}}</td>
                                <td>{{$product['price']}} $</td>
                                <td>{{$product['quantity']}}</td>
                                <td><a href="{{url('removeoneproduct/'.$product['id'])}}" class="btn btn-primary btn-outline btn-xs remove_btn">Remove</a></td>
                            </tr>
                        @endif


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script src="{{asset('assets/scripts/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/dataTables.scroller.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/dataTables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/table-advanced.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.rateit.js')}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            TableAdvanced.init();
            function reallySure(){
                var message = 'Are you sure about that?';
                action = confirm(message) ? true : event.preventDefault();
                console.log("what's going on?");
            }

            var aElems = document.getElementsByClassName('remove_btn');

            for (var i = 0, len = aElems.length; i < len; i++) {
                aElems[i].addEventListener('click', reallySure);
            }
        });
    </script>

@stop