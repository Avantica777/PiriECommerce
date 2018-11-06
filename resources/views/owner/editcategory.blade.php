@extends('layout.dashboard')
@section('page_heading','Edit Category')
@section('section')

    <div class="row">
        <form role="form" action="{{url('owner/updatecategory/'.$category[0]['id'])}}" method="post">
            <input type="hidden" name="_token" value={{csrf_token()}}>
            <div class="col-sm-6">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Category" name="category" value="{{$category[0]['category']}}">
                </div>

            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </form>
    </div>

@stop
