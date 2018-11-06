@extends('layout.layout')


@section('content')

    @if(!empty($succ))
        <div class="modal fade in" id="myModal" style = "display : block !important; border-radius: 10px !important;" role="dialog">
            <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content" style = "border-radius: 10px !important;">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Success!</h4>
                </div>
                <div class="modal-body">
                <p>Order has been placed Successfully.</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#myModal').fadeOut();">Close</button>
                </div>
            </div>
            
            </div>
        </div>
    @endif
    <div class="page-container">
        <div class="container">
            <div class="col-md-4 col-sm-4 col-xs-6 text-center">
                <a href="{{url('/')}}"><img src="{{url('assets/image/icons/product.png')}}" class="icon_hover margin-bottom-5"></a>
                <p><strong>All Products</strong></p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 text-center">
                <a href="{{url('buyer/transaction')}}"><img src="{{url('assets/image/icons/transaction.png')}}" class="icon_hover margin-bottom-5"></a>
                <p><strong>Transaction History</strong></p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                <a href="{{url('buyer/review')}}"><img src="{{url('assets/image/icons/review.png')}}" class="icon_hover margin-bottom-5"></a>
                <p><strong>Review</strong></p>
            </div>
        </div>
    </div>

@stop
