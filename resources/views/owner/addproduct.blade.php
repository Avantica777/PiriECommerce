@extends('layout.dashboard')
@section('page_heading','Add Product')
@section('section')

    <div class="row">
        <form role="form" action="{{url('owner/addproduct/'.$subcategory_id)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value={{csrf_token()}}>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Product ID : </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="number" name="product_id" value="{{$product_ID}}"/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Product Name : </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="product_name" placeholder="Product Name"/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Price : </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="price" placeholder="Price"/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Product Description : </label>
                    </div>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="description" placeholder="Product Description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Quantity : </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="quantity" placeholder="Quantity"/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Picture : </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" name="product_picture[]" multiple/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;margin-right: 50px;text-align: right">
                <button type="submit" class="btn btn-default">Add Product</button>
            </div>
        </form>
    </div>

@stop
@section('script')
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}","Info");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}","Warning");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}","Success");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}","Error");
                break;
        }
        @endif
    </script>
@stop
