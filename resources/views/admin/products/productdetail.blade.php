@extends('layout.layout')
@section('style')
    <link href="{{asset('assets/stylesheets/select2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/dataTables.scroller.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>

@stop
@section('content')

    <div class="container margin-top-20">
        <form id="edit-product-form" role="form" action="{{url('updateproduct/'.$product_id)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value={{csrf_token()}}>
            <div class="alert alert-danger display-hide danger-bg">
                <button class="close" data-close="alert"></button>
                Please confirm fields to change...
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Product ID</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <label>{{$detail[0]['product_id']}}</label>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Product Name</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="form-control" type="text" name="product_name" placeholder="Product Name" value="{{$detail[0]['product_name']}}"/>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Price</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="form-control" type="text" name="price" placeholder="Price" value="{{$detail[0]['price']}}"/>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Product Description</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" name="description" rows="5" placeholder="Product Description">{{$detail[0]['description']}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Quantity</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="form-control" type="text" name="quantity" placeholder="Quantity" value="{{$detail[0]['quantity']}}"/>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Picture</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
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
                            <a class="left carousel-control" href="#product_Carousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#product_Carousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label>Change Picture : </label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class = "col-md12 col-sm-12 col-xs-12 btn btn-default" onclick="$('#choose_pic').click();">Choose Picture</div>
                        <input class="form-control" id = "choose_pic" style = "display:none !important;" type="file" name="product_picture[]" multiple/>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20 margin-right-20 pull-right">
                <button type="submit" class="btn btn-primary">Change Product</button>
            </div>
        </form>
    </div>

@stop
@section('script')
    <script src="{{asset('assets/scripts/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/dataTables.scroller.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/dataTables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/table-advanced.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/form-validation.js')}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            TableAdvanced.init();
            FormValidation.init();
        });
    </script>

@stop