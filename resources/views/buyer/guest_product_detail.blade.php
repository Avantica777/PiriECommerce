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
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h1 class="product_title">Product Detail</h1>
                    <div class="content">
                        <div class="row margin-bottom-40">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12 margin-bottom-50">
                                    <div id = "product_Carousel" class="col-md-12 col-sm-12 col-xs-12 margin-bottom-50 carousel slide">
                                        <ol class="carousel-indicators">
                                            @foreach($detail['allpictures'] as $picture)
                                                <li data-target="#product_Carousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            @foreach($detail['allpictures'] as $picture)
                                            <div class="item {{ $loop->first ? 'active' : '' }}">
                                                <img src="{{url('products/'.$picture)}}" class="img-responsive margin-right-20">
                                            </div>
                                            @endforeach
                                        </div>
                                        <!-- <a class="left carousel-control" href="#product_Carousel" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#product_Carousel" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a> -->
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-5">
                                                <label><strong>Product ID</strong></label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-7">
                                                <label>{{$detail[0]['product_id']}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row margin-top-20">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-5">
                                                <label><strong>Product Name</strong></label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-7">
                                                <p>{{$detail[0]['product_name']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row margin-top-20">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-5">
                                                <label><strong>Price</strong></label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-7">
                                                <p>{{$detail[0]['price']}} $</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row margin-top-20">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-5">
                                                <label><strong>Product Description</strong></label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-7">
                                                <p>{{$detail[0]['description']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row margin-top-20">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-3 col-sm-3 col-xs-5">
                                                <label><strong>Quantity</strong></label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-7">
                                                <p>{{$detail[0]['quantity']}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <form class="product-size-form" action="{{url('guest/order/'.$product_id)}}" method="post">
                                                <input type="hidden" name="_token" value={{csrf_token()}}>
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <label><strong>Quantity To Buy</strong></label>
                                                </div>
                                                <div class="alert alert-danger display-hide danger-bg col-md-3 col-sm-3 col-xs-12">
                                                    <button class="close" data-close="alert"></button>
                                                    Please input quantity of product...
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                    <input class="form-control" type="text" name="quantity" placeholder="Quantity"/>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-6 pull-right">
                                                    <input type="submit" class="btn btn-primary margin-top-0" value="Order"/>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

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
            <h4>Sorry, Quantity of product is not enough...</h4>
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
    <script src="{{asset('assets/scripts/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/form-validation.js')}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            FormValidation.init();
        });
        @if(Session::has('message'))
        $(window).load(function () {
            $('#fail').modal('show');
        });
        @endif
    </script>
@stop


