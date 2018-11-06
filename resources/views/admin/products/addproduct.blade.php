@extends('layout.layout')
@section('style')
    <link href="{{asset('assets/stylesheets/select2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/dataTables.scroller.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/gallery.css')}}" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/bootstrap-modal.css')}}" rel="stylesheet" type="text/css"/>

@stop
@section('content')

    <div class="container margin-top-20">
        <form id="add-product-form" role="form" action="{{url('addproduct/'.$subcategory_id)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value={{csrf_token()}}>
            <div class="alert alert-danger display-hide danger-bg">
                <button class="close" data-close="alert"></button>
                Please confirm fields to add...
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Product ID</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="form-control" type="number" name="product_id" value="{{$product_ID}}"/>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Product Name</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="form-control" type="text" name="product_name" placeholder="Product Name"/>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Price</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="form-control" type="text" name="price" placeholder="Price"/>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Product Description</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" name="description" rows="5" placeholder="Product Description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Quantity</strong></label>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="form-control" type="text" name="quantity" placeholder="Quantity"/>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <label><strong>Picture</strong></label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" type="file" name="product_picture[]" multiple/>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20 margin-right-20 pull-right">
                <button type="submit" class="btn btn-primary">Add Product</button>
            </div>
        </form>
    </div>
    <div id="fail" class="modal fade" tabindex="-1" data-width="380px">
        <div class="modal-header modal-header-fail-color">
            <h4 class="modal-title white">Warning...</h4>
        </div>
        <div class="modal-body">
            <h4>Sorry, This ID already exist...</h4>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-success">Got it</button>
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
    <script src="{{asset('assets/scripts/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/form-validation.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/bootstrap-modal.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/ui-extended-modals.js')}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            TableAdvanced.init();
            FormValidation.init();
        });
        @if(Session::has('message'))
        $(window).load(function () {
            $('#fail').modal('show');
        });
        @endif
    </script>

@stop