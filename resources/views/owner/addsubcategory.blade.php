@extends('layout.dashboard')
@section('page_heading','Add Sub Category')
@section('section')

    <div class="row">
        <form role="form" action="{{url('owner/addsubcategory/'.$category_id)}}" method="post">
            <input type="hidden" name="_token" value={{csrf_token()}}>
            <div class="col-sm-6">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Sub Category" name="subcategory">
                    <label>Please input sub category...</label>
                </div>

            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-default">Add</button>
            </div>
        </form>
    </div>

@stop
