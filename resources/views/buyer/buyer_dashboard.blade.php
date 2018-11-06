@extends('layout.layout')

@section('style')
    <link href="{{asset('assets/stylesheets/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/gallery.css')}}" rel="stylesheet">
    <link href="{{asset('assets/stylesheets/style-mo.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" crossorigin="anonymous">
    <style rel = "stylesheet">
        .m_class_left {
            position: absolute;
            top: 0;bottom: 0;
            left: 0;width: 5%;
            font-size: 20px;
            color: #b7e8be;
            text-align: center;
            text-shadow: 0 1px 2px rgba(0,0,0,.6);
            filter: alpha(opacity=50);opacity: .5;
            cursor: pointer;
            z-index: 101;
        }

        .m_class_left:hover {
            filter: alpha(opacity=100);opacity: 1;
        }
        .m_class_right {
            position: absolute;
            top: 0;bottom: 0;
            right: 0;width: 5%;
            font-size: 20px;
            color: #b7e8be;
            text-align: center;
            text-shadow: 0 1px 2px rgba(0,0,0,.6);
            filter: alpha(opacity=50);opacity: .5;
            cursor: pointer;
            z-index: 101;
        }

        .m_class_right:hover {
            filter: alpha(opacity=100);opacity: 1;
        }

        .m_span {
            width: 32px;
            height: 32px;
            font-size: 25px !important;
        }
    </style>
@stop
@section('content')
    <div class="main">
        <div class="container">

            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40 margin-top-20">
                <h1 class="product_title">All Categories</h1>
                <!-- BEGIN CONTENT -->
                <div class="col-md-12">
                    <div class="content carousel slide">
                        <div class="row margin-bottom-40 fd_class">
                            @foreach($pictures as $picture)
                                <div class="col-md-3 col-sm-4 col-xs-12 gallery-item" style = "display:none !important;">
                                    <a title="{{$picture['product_name']}}" href="{{url('guest/productdetail/'.$picture['id'])}}" class="fancybox-button">
                                        <img alt="product" src="{{url('products/'.$picture['picture'])}}" style = "max-width:100%" class="img-responsive myimg">
                                        <div class="zoomix"><i class="fa fa-search"></i></div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="m_class_left" onclick="slide_image(true);">
                            <span class="glyphicon glyphicon-chevron-left m_span" style = "margin: auto; vertical-align: middle; top: 45%;" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </div>
                        <div class="m_class_right" onclick="slide_image(false);">
                            <span class="glyphicon glyphicon-chevron-right m_span" style = "margin: auto; vertical-align: middle; top: 45%;" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->

                <!-- BEGIN ALL CATEGORIES CONTENT -->
                <div class="row">
                    <div class = "col-md-12 com-sm-12 com-xs-12">
                        <label>Search:
                            <input type="search" id = "search_category" class="form-control input-small input-inline" onsearch="findItem();" style = "border-radius: 5px !important;" placeholder="" aria-controls="pgTable">
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12  table-scrollable">
                        <div class="tabbable tabbable-custom tabbable-noborder table table-striped dataTable no-footer" id = "pgTable">
                            <div class="tab-pane padding-30">
                                <!-- BEGIN FILTER -->
                                <div class="margin-top-10">
                                    <div class="row mix-grid sorting-disabled" id="category_area" aria-controls="sample_6">
                                        @foreach($categories as $category)
                                            <div class="col-md-4 col-sm-6 col-xs-12 mix text-center">
                                                <a href="{{url('subcategories/'.$category['id'])}}" class="category-style">
                                                    <div class="col-md-4 col-sm-6 col-xs-12 mix text-center">
                                                        <span>
                                                            {{$category['category']}}
                                                        </span>
                                                        <img src="http://localhost:8000/uploads/pretty.jpg" class="img-rounded img-responsive" alt="Cinque Terre">
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- END FILTER -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN ALL CATEGORIES CONTENT -->
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        function findItem(){
        }
        var aElems = document.getElementsByClassName('gallery-item');
        var len = aElems.length;
        var ind_left = 0;
        var ind_right = 0;

        $( document ).ready(function() {
            init(4);
            window.addEventListener("resize", function(){
                if(window.innerWidth>=992)
                    init(4);
                else if(window.innerWidth<992 && window.innerWidth>=768)
                    init(3);
                else if(window.innerWidth<768)
                    init(1);
            });
        });
        function init(number){
            var cnt = number;
            if(len>cnt){
                ind_right = cnt-1;
                for (var i = ind_left; i <= ind_right ; i++) {
                    aElems[i].style.display = "block";
                }
                for(i = ind_right+1 ; i < len ; i ++){
                    aElems[i].style.display = "none";
                }
            }
            else
                ind_right = len-1;
        }
        
        function slide_image(flag){
            if(!flag)        //right clicked
            {
                ind_right ++;
                if(ind_right>=len)
                {
                    ind_right --;
                }    
                else
                {
                    aElems[ind_left].style.display = "none";
                    aElems[ind_right].style.display = "block";
                    ind_left ++;
                }
            }else{
                ind_left --;
                if(ind_left<0){
                    ind_left ++;
                }else{
                    aElems[ind_right].style.display = "none";
                    aElems[ind_left].style.display = "block";
                    ind_right --;
                }
            }
        }
    </script>
@stop
