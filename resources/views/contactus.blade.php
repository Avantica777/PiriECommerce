@extends('layout.layout')


@section('content')
<script>
    $(".glow").css("display","none");
</script>
<div class="container">
    <div class="row">

        <div class="col-lg-6 col-md-6 col-xs-12">
            <img class="img-responsive" src="https://piritravels.com/assets/image/icons/logo.png" style="margin: auto">
        </div>


        <div class="col-lg-6 col-md-6 col-xs-12">
            <h1 style="font-family: 'Mali',cursive;font-weight: bold;text-align: center">Contact Us</h1>
            <div class="content">
                <div class="row margin-bottom-30">

                    <div class="col-xs-12">
                        <form action="https://piritravels.com/sendmail" class="reviews-form" role="form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="AiaRKyoNPoMLCe6JGVz4XecxKc5Z4S669as3PYUB">
                            <div class="form-group">
                                <div class=" col-xs-12 margin-top-10">
                                    <input type="text" class="form-control text-center" name="first_name" placeholder="First Name">
                                </div>
                                <div class=" col-xs-12 margin-top-10">
                                    <input type="text" class="form-control text-center" name="last_name" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class=" col-xs-12 margin-top-10">
                                    <input type="text" class="form-control text-center" name="subject" placeholder="Subject">
                                </div>

                            </div>

                            <div class="form-group">
                                <div class=" col-xs-12 margin-top-10">
                                    <input type="email" class="form-control text-center" name="email" placeholder="Email">
                                </div>

                            </div>

                            <div class="form-group">
                                <div class=" col-xs-12 margin-top-10">
                                    <textarea class="form-control" rows="12" name="message" placeholder="Message"></textarea>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-xs-12 margin-top-10">
                                    <button type="submit" onclick="ContactusValidation()" class="btn btn-primary btn-block">
                                        Send
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>                
    </div>

</div>

@stop
