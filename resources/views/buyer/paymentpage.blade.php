@extends('layout.layout')

@section('style')
    <link href="{{asset('assets/stylesheets/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/gallery.css')}}" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/bootstrap-modal.css')}}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="main">
        <div class="container">

            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40 margin-top-20">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12">
                    <h1 class="product_title margin-bottom-40">Payment Page</h1>
                    <div class="content">
                        <div class="row margin-bottom-40">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-5">
                                                <label><strong>Part Number</strong></label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-7">
                                                <p>{{$order['partnumber']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-5">
                                                <label><strong>Product Name</strong></label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-7">
                                                <p>{{$order['product_name']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-5">
                                                <label><strong>Price</strong></label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-7">
                                                <p>{{$order['price']}} $</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-5">
                                                <label><strong>Quantity</strong></label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-7">
                                                <p>{{$order['quantity']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-5">
                                                <label><strong>Total Price</strong></label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-7">
                                                <p>{{$order['total_price']}} $</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="colmd12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-12"></div>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <form action="{{url('buyer/pay/'.$order['partnumber'].'/'.$order['quantity'].'/'.(int)($order['total_price'])*100)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <script
                                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                            data-key="{{ env('STRIPE_KEY') }}"
                                                            data-amount="{{(int)($order['total_price'])*100}}"
                                                            data-name="Piri Commerce"
                                                            data-description="Widget"
                                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                                            data-locale="auto"
                                                            data-currency="usd">
                                                    </script>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 margin-top-20" style = "display:none">
                                    <a href="{{url('buyer/report/'.$order['customername'].'/'.$order['partnumber'].'/'.$order['quantity'].'/'.$order['description'].'/'.$order['total_price'].'/'.$order['email_addr'].'/download')}}" class="btn btn-outline    btn-xs   ">Download Receipt</a>
                                    <a href="{{url('buyer/report/'.$order['customername'].'/'.$order['partnumber'].'/'.$order['quantity'].'/'.$order['description'].'/'.$order['total_price'].'/'.$order['email_addr'].'/view')}}" class="btn btn-outline    btn-xs   ">View Receipt</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>
    <div id="fail" class="modal fade" tabindex="-1" data-width="380px">
        <div class="modal-header modal-header-fail-color">
            <h4 class="modal-title white">Warning...</h4>
        </div>
        <div class="modal-body">
            <h4>Please input quantity of product correctly...</h4>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-success">Got it</button>
        </div>
    </div>
@stop
@section('script')
    <script src="{{asset('assets/scripts/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/bootstrap-modal.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/ui-extended-modals.js')}}" type="text/javascript"></script>
    <script>
        @if(Session::has('message'))
        $(window).load(function () {
            $('#fail').modal('show');
        });
        @endif
    </script>
@stop
