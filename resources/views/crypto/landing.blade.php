<style>
.bg {
    /* The image used */
    background-image: url("{{ asset('image/Hollywood.jpg') }}");

    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
} 

.gap {
    margin-top: 100px;
}
</style> 

@extends('layouts.crypto')

@section('content')
<div class="container-fluid bg">
    <div class="row justify-content-center">
        <div class="col-sm-5 col-md-4 gap">
            <div class="alert alert-success" style="display:none"></div>
            <div class="alert alert-danger" style="display:none"></div>
            <div class="card" style="background-color: rgb(255, 255, 255);">
                <div class="card-header"><h3>Get your username!</h3></div>

                <div class="card-body">
                    {!! Form::open(['id' => 'people_sign_up' , 'action' => 'PeoplesController@store', 'method'=> 'POST']) !!}
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required="" autofocus="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="username" required="">

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-md-push-1 gap text-white">
                <h2>Meet The Future</h2>
                <div class="row">
                    <div class="col-md-10">
                        <div class="intro-box">
                            <span class="oi oi-thumb-up"></span>
                            <div>
                                <h4>Collect.</h4>
                                <h4>Trade.</h4>
                                <h4>Sell.</h4>
                                <h4>Share with friends.</h4>
                                <!--p>Lorem ipsum dolor sit amet consec tetur elit amet voluptas accusamus dolorum veritatis ea odio dolor emque.</p-->
                            </div>
                        </div>
                        <!--div class="intro-box">
                            <span class="fa fa-magnet"></span>
                            <div>
                                <h4>MAGNET ICON</h4>
                                <p>Lorem ipsum dolor sit amet consec tetur elit amet voluptas accusamus dolorum veritatis ea odio dolor emque.</p>
                            </div>
                        </div-->
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    var form = $('#people_sign_up');
    form.submit(function(e) {

    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    $.ajax({
        url     : form.attr('action'),
        type    : form.attr('method'),
        data    : form.serialize(),
        dataType: 'json',
        success : function ( data )
        {
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success').append('<p>' + data.success + '</p>');
        },
        error: function( data )
        {
            $('.alert-success').hide();
            if(data.status === 422) {
                $('.alert-danger').show();
                $.each(data.responseJSON.errors, function (key, value) {
                    $('.alert-danger').empty().append('<p>'+value+'</p>');
                });
            } else {
                $('.alert-danger').show();
                $('.alert-danger').empty().append('<p>There was an error processing your request. Please try again.</p>');
            }
        }
    });
 });

});
</script>
@endsection








