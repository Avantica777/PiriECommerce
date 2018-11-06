@extends('layout.dashboard')
@section('page_heading','Edit Sub Category')
@section('section')

    <div class="row">
        <form role="form" action="{{url('owner/updatesubcategory/'.$subcategory[0]['id'])}}" method="post">
            <input type="hidden" name="_token" value={{csrf_token()}}>
            <div class="col-sm-6">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Sub Category" name="subcategory" value="{{$subcategory[0]['sub_category']}}">
                </div>

            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </form>
    </div>

@stop
