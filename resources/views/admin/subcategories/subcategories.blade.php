@extends('layout.layout')


@section('content')

    <div class="container">
        <h3 class="tag_title">PLEASE ENTER THE SUBCATEGORY NAME TO ADD</h3>
        <div class="content text-center margin-top-20">
            <form id="subcategory-form" action="{{url('addsubcategory/'.$category_id)}}" method="post">
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
                            <input class="form-control" type="text" name="subcategory" placeholder="Subcategory Name"/>
                        </div>
                        <div class="form-group">
                            <label class="form-control btn btn-default" onclick="$('#chooseFile').click()">Select Category Image</label>
                            <input class="form-control" type="file" name="subcategory" id="chooseFile" style = "display:none"/>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn blue">Add Subcategory</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12"></div>
                </div>
            </form>
        </div>
        <div class="row">
            <hr>
            <div class = "col-md-3 com-sm-3 com-xs-3" style="float:right;margin-top:10px;margin-right:200px">
                <label>Search:
                    <input type="search" id = "search_subcategory" class="form-control input-small input-inline" onsearch="findItem();" style = "border-radius: 5px !important;" placeholder="" aria-controls="pgTable">
                </label>
            </div>
            <hr>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="tabbable tabbable-custom tabbable-noborder ">

                    <div class="tab-pane padding-30">
                        <!-- BEGIN FILTER -->
                        <div class="margin-top-10">
                            <div class="row mix-grid" id="country_area">
                                @foreach($subcategories as $subcategory)
                                    <div class="col-md-4 col-sm-6 col-xs-12 mix text-center">
                                        <a href="{{url('products/'.$subcategory['id'])}}" class="category-style">{{$subcategory['sub_category']}}</a>
                                        <a href="{{url('removesubcategory/'.$subcategory['id'])}}" class="margin-left-20 trash remove_btn"><i class="fa fa-trash" style="font-size: 30px"></i> </a>
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