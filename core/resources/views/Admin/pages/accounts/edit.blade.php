@extends('admin.layouts.backend')

@section('title')
    Edit Account
@endsection

@section('css')
    <link rel="stylesheet"
          href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">

        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Editing Account</h3>

                <div class="block-options">
                    <a href="/admin/accounts/all" class="btn btn-sm btn-alt-primary">
                        <i class="far fa-fw fa-circle-left"></i> Back to list
                    </a>
                </div>

            </div>
            <div class="block-content block-content-full">

                <form>
                    <div class="row">

                        @include('admin.includes.message')

                        <div class="row">
                            <div class="col-lg-3">
                                <img
                                    src="{{ asset('assets/game_img/chars') }}/{{ $account->firstChar }}.jpg"
                                    width=90%" alt="Character">
                            </div>
                            <div class="col-lg-5">

                                <div class="mb-4">
                                    <label class="form-label" for="IsNew">E-mail</label>
                                    <input type="text" class="form-control" id="email"
                                           name="email" value="{{$account->email}}"
                                           placeholder="Account email access">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password"
                                           name="password" placeholder="Type new password account access">
                                    <small class="text-info">Leave blank to not change user password.</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="AccountStatus">Account Status</label>
                                    <select class="form-select" id="AccountStatus" name="AccountStatus">
                                        <option value="">--- Select a status for account --</option>
                                        <option value="100" {{ ($account->AccountStatus == 100) ? "selected" : "" }}>
                                            Normal
                                        </option>
                                        <option value="200" {{ ($account->AccountStatus != 100) ? "selected" : "" }}>
                                            Banned
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="IsDevelopers">Account Permission</label>
                                    <select class="form-select" id="IsDevelopers" name="IsDevelopers">
                                        <option value="">--- Select a role for account --</option>
                                        <option value="0" {{ ($account->IsDeveloper == 0) ? "selected" : "" }}>Player
                                        </option>
                                        <option value="126" {{ ($account->IsDeveloper != 0) ? "selected" : "" }}>
                                            Master Developer
                                        </option>
                                    </select>

                                    <small class="text-warning">* Warning for give access to one
                                        account!</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="AccountType">Account Type</label>
                                    <select class="form-select" id="AccountType" name="AccountType">
                                        <option value="">--- Select a role for account --</option>
                                        <option value="0" {{ ($account->AccountType == 0) ? "selected" : "" }}>Legend
                                        </option>
                                        <option value="1" {{ ($account->AccountType == 1) ? "selected" : "" }}>
                                            Survivor
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="BadLoginCount">Bad Login Count</label>
                                    <input type="text" class="form-control" id="BadLoginCount"
                                           name="BadLoginCount" value="{{$account->BadLoginCount}}"
                                           placeholder="Bad Login Count">
                                </div>

                                <div class="input-group">
                                    <button type="submit" class="btn btn-alt-success me-1 mb-3"
                                            id="submit-button"
                                            name="submit-button">
                                        <i class="fa fa-fw fa-check opacity-50 me-1"></i> Save
                                    </button>
                                </div>

                            </div>
                            <div class="col-lg-4">

                                <div class="mb-2">
                                    <label class="form-label" for="GamePoints">GC and GD</label>
                                    <div class="input-group">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="GamePoints"
                                                   name="GamePoints"
                                                   value="{{$account->UserData->GamePoints}}">

                                            <span class="input-group-text"><img
                                                    src="{{ asset('assets/media/game/game_points.png') }}"
                                                    alt="GamePoints"> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="GameDollars"
                                               name="GameDollars"
                                               value="{{$account->UserData->GameDollars}}">

                                        <span class="input-group-text"><img
                                                src="{{ asset('assets/media/game/game_dollar.png') }}"
                                                alt="GameDollars"> </span>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label class="form-label" for="example-flatpickr-datetime-24">Premium Expire
                                        Left</label>
                                    <input type="text" class="js-flatpickr form-control"

                                           data-enable-time="true" data-time_24hr="true"
                                           value="{{  $account->UserData->PremiumExpireTime }}">
                                </div>

                                <div class="mb-2">
                                    <label class="form-label" for="example-flatpickr-datetime-24">Last Premium
                                        Bonus</label>
                                    <input type="text" class="js-flatpickr form-control disabled"
                                           disabled
                                           data-enable-time="true" data-time_24hr="true"
                                           value="{{  $account->UserData->PremiumLastBonus }}">
                                </div>

                            </div>

                            <hr>
                            <br>

                            <div class="input-group text-center" hidden>
                                <a href="" class="btn btn-alt-info me-1 mb-3"
                                   id="submit-button"
                                   name="submit-button">Chars
                                </a>

                                <a href="" class="btn btn-alt-info me-1 mb-3"
                                   id="submit-button"
                                   name="submit-button">Inventory
                                </a>

                                <a href="" class="btn btn-alt-info me-1 mb-3"
                                   id="submit-button"
                                   name="submit-button">Add Premium
                                </a>

                                <a href="" class="btn btn-alt-info me-1 mb-3"
                                   id="submit-button"
                                   name="submit-button">User Logs
                                </a>

                                <a href="" disabled class="btn btn-alt-info me-1 mb-3 disabled"
                                   id="submit-button"
                                   name="submit-button">Payments
                                </a>
                            </div>
                        </div>


                    </div>

                </form>

            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script>
        $('#error').hide();
        $('#message').hide();
        $('#messageSuccess').hide();

        // Form send
        var submitButton = $("#submit-button");
        $("#submit-button").click(function (event) {

            submitButton.text('Saving...');
            submitButton.prop("disabled", true);

            // Getting the field values
            var email = $('#email').val();
            var password = $('#password').val();
            var AccountStatus = $('#AccountStatus').val();
            var IsDevelopers = $('#IsDevelopers').val();
            var AccountType = $('#AccountType').val();
            var BadLoginCount = $('#BadLoginCount').val();
            var GamePoints = $('#GamePoints').val();
            var GameDollars = $('#GameDollars').val();

            // Creating the data object to send
            var formData = JSON.stringify({
                email: email,
                password: password,
                AccountStatus: AccountStatus,
                IsDevelopers: IsDevelopers,
                AccountType: AccountType,
                BadLoginCount: BadLoginCount,
                GamePoints: GamePoints,
                GameDollars: GameDollars
            });

            var getID = <?php echo $account->CustomerID; ?>;
            var apiUrl = `/api/v1/accounts/update/${getID}`;

            // Sending the POST request via Ajax
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: apiUrl,
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
                        $('#messageSuccessDetail').text(data.message);

                        // Update new info
                        $("#email").val(data.updated.email);
                        $("#password").val(data.updated.password);
                        $("#AccountStatus").val(data.updated.AccountStatus);
                        $("#IsDevelopers").val(data.updated.IsDevelopers);
                        $("#BadLoginCount").val(data.updated.BadLoginCount);
                        $("#AccountType").val(data.updated.user_data.AccountType);
                        $("#GamePoints").val(data.updated.user_data.GamePoints);
                        $("#GameDollars").val(data.updated.user_data.GameDollars);

                        submitButton.text('Saved!');
                        submitButton.prop("disabled", false);

                        setTimeout(function () {
                            $('#error').hide();
                            $('#message').hide();
                            $('#messageSuccess').hide();
                            $("#submit-button").text('Save');
                            submitButton.prop("disabled", false);
                        }, 3000);
                    }

                    if (data.type === 'error') {
                        $('#messageSuccess').hide();
                        $('#error').show();
                        $('#errorDetail').text(data.msg);

                        submitButton.text('Save');
                        submitButton.prop("disabled", false);
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

                    submitButton.text('Save');
                    submitButton.prop("disabled", false);

                }
            });
        });

    </script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Maxlength + Select2 + Ion Range Slider + Masked Inputs + Password Strength Meter plugins) -->
    <script>Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker', 'jq-maxlength', 'jq-select2', 'jq-rangeslider', 'jq-masked-inputs', 'jq-pw-strength']);</script>
@endsection
