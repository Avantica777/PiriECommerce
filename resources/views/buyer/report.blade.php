<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <h2 style="text-align: center">RECEIPT</h2>
        <div class="row">
            <label style="font-weight: bold">Customer Name : </label>
            <label>{{$report['customername']}}</label>
        </div>
        <div class="row" style="margin-top: 20px">
            <label style="font-weight: bold">Email : </label>
            <label>{{$report['email_addr']}}</label>
        </div>
        <div class="row" style="margin-top: 20px">
            <label style="font-weight: bold">Part Number : </label>
            <label>{{$report['partnumber']}}</label>
        </div>
        <div class="row" style="margin-top: 20px">
            <label style="font-weight: bold">Quantity : </label>
            <label>{{$report['quantity']}}</label>
        </div>
        <div class="row" style="margin-top: 20px">
            <label style="font-weight: bold">Product Description : </label>
            <label>{{$report['description']}}</label>
        </div>
        <div class="row" style="margin-top: 20px">
            <label style="font-weight: bold">Total Price : </label>
            <label>{{$report['total_price']}} $</label>
        </div>
    </div>
</div>
</body>
</html>