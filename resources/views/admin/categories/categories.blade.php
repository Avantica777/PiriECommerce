@extends('layout.layout')


@section('content')

    <div class="container">
        <h3 class="tag_title">PLEASE ENTER THE CATEGORY NAME TO ADD</h3>
        <div class="content text-center margin-top-20">
            <form id="category-form" action="{{url('addcategory')}}" method="post">
                <input type="hidden" name="_token" value={{csrf_token()}}>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12"></div>
                    <div class="col-md-4 col-sm-4">
                        <div class="alert alert-danger display-hide danger-bg">
                            <button class="close" data-close="alert"></button>
                            You have some form errors. Please check below.
                        </div>
                        <div class="alert alert-success display-hide success-bg">
                            <button class="close" data-close="alert"></button>
                            Your form validation is successful!
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="category" placeholder="Category Name"/>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn blue">Add Category</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12"></div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="tabbable tabbable-custom tabbable-noborder ">

                    <div class="tab-pane padding-30">
                        <!-- BEGIN FILTER -->
                        <div class="margin-top-10">
                            <div class="row mix-grid" id="country_area">
                                @foreach($categories as $category)
                                    <div class="col-md-4 col-sm-6 col-xs-12 mix text-center">
                                        <a href="{{url('subcategories/'.$category['id'])}}" class="category-style">{{$category['category']}}</a>
                                        <a href="{{url('removecategory/'.$category['id'])}}" class="margin-left-20 trash remove_btn"><i class="fa fa-trash" style="font-size: 30px"></i> </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- END FILTER -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('script')
    <script src="{{asset('assets/scripts/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/form-validation.js')}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            FormValidation.init();
            function reallySure(){
                var message = 'Are you sure about that?';
                action = confirm(message) ? true : event.preventDefault();
                console.log("what's going on?");
            }

            var aElems = document.getElementsByClassName('remove_btn');

            for (var i = 0, len = aElems.length; i < len; i++) {
                aElems[i].addEventListener('click', reallySure);
            }
        })
    </script>
@stop