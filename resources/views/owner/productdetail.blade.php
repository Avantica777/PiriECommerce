@extends('layout.dashboard')
@section('page_heading','Product Detail')
@section('section')

    <div class="row">
        <form role="form" action="{{url('owner/updateproduct/'.$product_id)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value={{csrf_token()}}>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Product ID : </label>
                    </div>
                    <div class="col-sm-9">
                        <label>{{$detail[0]['product_id']}}</label>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Product Name : </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="product_name" placeholder="Product Name" value="{{$detail[0]['product_name']}}"/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Price : </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="price" placeholder="Price" value="{{$detail[0]['price']}}"/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Product Description : </label>
                    </div>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="description" placeholder="Product Description">{{$detail[0]['description']}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Quantity : </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="quantity" placeholder="Quantity" value="{{$detail[0]['quantity']}}"/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Limit : </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="limit" placeholder="limit" value="{{$detail[0]['limit']}}"/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Picture : </label>
                    </div>
                    <div class="col-sm-9">
                        @foreach($detail['allpictures'] as $picture)
                            <img src="{{url('products/'.$picture)}}" style="width: 150px;height: 100px;margin-right: 20px">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <label>Change Picture : </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" name="product_picture[]" multiple/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;margin-right: 50px;text-align: right">
                <button type="submit" class="btn btn-default">Change Product</button>
            </div>
        </form>
    </div>

@stop
