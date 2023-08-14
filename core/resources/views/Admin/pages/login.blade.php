@extends('admin.layouts.blank')

@section('content')

    <div class="bg-image" style="background-image: url('/assets/media/photos/photo19@2x.jpg');">
        <div class="row g-0 justify-content-center bg-primary-dark-op">
            <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">

                <!-- Sign In Block -->
                <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                    <div
                        class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">

                        <!-- Header -->
                        <div class="mb-2 text-center">
                            <a class="link-fx fw-bold fs-1" href="">
                                <span class="text-dark">{{getenv("APP_NAME")}}</span><span
                                    class="text-primary"> Admin</span>
                            </a>
                            <p class="text-uppercase fw-bold fs-sm text-muted">Sign In</p>
                        </div>
                        <!-- END Header -->

                        @include('admin.includes.message')

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-signin">

                            <div class="mb-4">
                                <div class="input-group input-group-lg">
                                    <input type="email" class="form-control" id="login-email" name="login-email"
                                           placeholder="Email">
                                    <span class="input-group-text">
                          <i class="fa fa-user-circle"></i>
                        </span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="input-group input-group-lg">
                                    <input type="password" class="form-control" id="login-password"
                                           name="login-password" placeholder="Password">
                                    <span class="input-group-text">
                                      <i class="fa fa-asterisk"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-hero btn-primary" id="submit-button"
                                        name="submit-button">
                                    <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Sign In
                                </button>
                            </div>
                        </form>
                        <!-- END Sign In Form -->
                    </div>
                    <div class="block-content bg-body">
                        <div class="d-flex justify-content-center text-center push text-warning">
                            System restricted to Team only, please close this window if you are lost.
                        </div>
                    </div>
                </div>
                <!-- END Sign In Block -->
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script>
        $('#error').hide();
        $('#message').hide();
        $('#messageSuccess').hide();

        //$(document).ready(function (){

        $("#submit-button").click(function (event) {

            $("#submit-button").text('Logging...');
            $("#submit-button").prop("disabled", true);

            // Getting the field values
            var email = $('#login-email').val();
            var password = $('#login-password').val();

            // Creating the data object to send
            var formData = JSON.stringify({
                email: email,
                password: password
            });

            // Sending the POST request via Ajax
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/admin/login',
                //url: '/api/v1/auth/login',
                data: formData,
                contentType: 'application/json',
                dataType: 'json',
                beforeSend: function () {
                    $('#error').hide();
                    $('#message').hide();
                    $('#messageSuccess').hide();
                },
                success: function (data) {

                    if (data.type === 'success') {
                        $('.js-validation-signin').hide();
                        $('#error').hide();
                        $('#messageSuccess').show();
                        $('#messageSuccessDetail').text(data.msg);

                        window.location.href = data.redirect;

                        $("#submit-button").text('Sign In');
                        $("#submit-button").prop("disabled", false);
                    }

                    if (data.type === 'error') {
                        $('#messageSuccess').hide();
                        $('#error').show();
                        $('#errorDetail').text(data.msg);

                        $("#submit-button").text('Sign In');
                        $("#submit-button").prop("disabled", false);
                    }

                    // Reset fields
                    //$('input').val('');
                    //$('select').val('');
                },
                error: function (xhr, status, error) {

                    //$("#card-block").unblock();

                    var errors = xhr.responseJSON.errors;

                    //if (xhr.status == 401) {
                    $.each(errors, function (key, value) {
                        $('#messageSuccess').hide();
                        $('#error').show();
                        $('#errorDetail').text('* ' + value);
                    });
                    //}

                    $("#submit-button").text('Sign In');
                    $("#submit-button").prop("disabled", false);

                }
            });
        });

        //});
    </script>
@endsection
