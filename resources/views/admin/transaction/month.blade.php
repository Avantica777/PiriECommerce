@extends('layout.layout')

@section('content')

    <div class="page-container">
        <div class="container">
            @foreach($months as $month)
                @if($month == date('F') and $year == date('Y'))
                    <div class="col-md-3 col-sm-4 col-xs-6 text-center margin-top-20">
                        <a href="{{url('transaction/'.$year.'/'.$month)}}" class="month-style this">{{$month}}</a>
                    </div>
                @else
                    <div class="col-md-3 col-sm-4 col-xs-6 text-center margin-top-20">
                        <a href="{{url('transaction/'.$year.'/'.$month)}}" class="month-style">{{$month}}</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

@stop
