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

    <h3 class="tag_title">Transaction History</h3>
    <div class="container">
        <div class="portlet box table-header-blue">
            <div class="portlet-title">
                <div class="caption">
                    <!-- <i class="fa fa-money" style="color: white;"></i>Transaction History -->
                </div>
            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover" id="sample_6">

                    <thead class="thead-color">
                    <tr>
                        <th>Buyer</th>
                        <th>Product ID</th>
                        <th>Prodcut Name</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Transaction Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($alltransactions as $alltransaction)

                        <tr>
                            <td>{{$alltransaction['buyer']}}</td>
                            <td>{{$alltransaction['product_id']}}</td>
                            <td>{{$alltransaction['product_name']}}</td>
                            <td>{{$alltransaction['category']}}</td>
                            <td>{{$alltransaction['sub_category']}}</td>
                            <td>{{$alltransaction['quantity']}}</td>
                            <td>{{$alltransaction['total_price']}} $</td>
                            <td>{{$alltransaction['posted_at']}}</td>
                        </tr>


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
        });
    </script>

@stop