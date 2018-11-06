@extends('layout.layout')

@section('style')
    <link href="{{asset('assets/stylesheets/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/gallery.css')}}" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/bootstrap-modal.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/stylesheets/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/rateit.css')}}" rel="stylesheet" type="text/css">
@stop
@section('content')
    <div class="main">
        <div class="container">

            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h1 class="product_title">Wirte Review</h1>
                    <div class="content">
                        <div class="row margin-bottom-40">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-6 col-sm-6 col-xs-12 margin-bottom-50">
                                    @foreach($detail['allpictures'] as $picture)
                                        <div class="col-md-3 col-sm-4 col-xs-6">
                                            <img src="{{url('products/'.$picture)}}" class="img-responsive margin-right-20">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <form action="{{url('buyer/writereview/'.$product_ID)}}" id="reviews-form" role="form" method="post">
                                        <input type="hidden" name="_token" value={{csrf_token()}}>
                                        <div class="alert alert-danger display-hide danger-bg">
                                            <button class="close" data-close="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-hide success-bg">
                                            <button class="close" data-close="alert"></button>
                                            Your form validation is successful!
                                        </div>
                                        <div class="form-group">
                                            <p>Rating</p>
                                            <input type="range" value="5" step="0.25" id="backing5" name="rating">
                                            <div class="rateit" data-rateit-backingfld="#backing5" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="review">Review</label>
                                            <textarea class="form-control" rows="8" id="review" name="review"></textarea>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary button-width">Send</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>

    <div id="exist" class="modal fade" tabindex="-1" data-width="380px">
        <div class="modal-header modal-header-fail-color">
            <h4 class="modal-title white">Warning...</h4>
        </div>
        <div class="modal-body">
            <h4>You already gave review to this product...</h4>
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
    <script src="{{asset('assets/scripts/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.rateit.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/form-validation.js')}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            FormValidation.init();
        });
        @if(Session::has('exist'))
        $(window).load(function () {
            $('#exist').modal('show');
        });
        @endif
    </script>
@stop
