@extends('layout.dashboard')
@section('page_heading','Total Products')
@section('section')

    <div class="row">
        <div class="col-sm-12">
            @section ('stable_panel_title','Total Products')
            @section ('stable_panel_body')
                @include('widgets.totalproducts', array('class'=>'table-striped'))
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
        </div>

    </div>

@stop
@section('script')
    <script>
        @foreach($products as $product)
            var type = "{{ $product['notification']['alert-type'] }}";
            switch(type){
                case 'info':
                    toastr.info("{{ $product['notification']['message'] }}","Info");
                    break;

                case 'warning':
                    toastr.warning("{{ $product['notification']['message'] }}","Warning");
                    break;

                case 'success':
                    toastr.success("{{ $product['notification']['message'] }}","Success");
                    break;

                case 'error':
                    toastr.error("{{ $product['notification']['message'] }}","Error");
                    break;
            }
        @endforeach
    </script>
@stop