@extends('layout.layout')

@section('content')

    <div class="page-container">
        <div class="container">
            @foreach($years as $year)
                @if($year == date('Y'))
                    <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                        <a href="{{url('transaction/'.$year)}}" class="year-style this">{{$year}}</a>
                    </div>
                @else
                    <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                        <a href="{{url('transaction/'.$year)}}" class="year-style">{{$year}}</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

@stop
