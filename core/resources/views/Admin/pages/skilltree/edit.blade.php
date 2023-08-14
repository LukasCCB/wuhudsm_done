@extends('admin.layouts.backend')

@section('title')
    Edit Skilltree
@endsection

@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">

        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Editing Skilltree</h3>

                <div class="block-options">
                    <a href="/admin/skilltree" class="btn btn-sm btn-alt-primary">
                        <i class="far fa-fw fa-circle-left"></i> Back to list
                    </a>
                </div>
            </div>
            <div class="block-content block-content-full">

                <form>
                    <div class="row">
                        <div class="">
                            <div class="block-content">

                                @include('admin.includes.message')

                                <div id="blockUi">
                                    <div class="mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                              Name
                                            </span>
                                            <input type="text" class="form-control" id="Name"
                                                   name="Name" value="{{$skilltree->Name}}">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                              Category
                                            </span>
                                            <input type="text" class="form-control" id="category"
                                                   name="category" value="{{$skilltree->Category}}">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                             Price
                                            </span>

                                            <input type="number" class="form-control" id="lv1"
                                                   name="lv1" value="{{$skilltree->Lv1}}">

                                            <span class="input-group-text">
                                                <img src="{{ asset('assets/media/game/game_points.png') }}"
                                                     alt="GamePoints">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="input-group">
                                            <textarea class="input-group-text" name="description" id="description"
                                                      cols="150" rows="5">{{$skilltree->Description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <button type="submit" class="btn btn-alt-success me-1 mb-3" id="submit-button" name="submit-button">
                                            <i class="fa fa-fw fa-check opacity-50 me-1"></i> Save
                                        </button>
                                    </div>
                                </div>

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

        var submitButton = $("#submit-button");

        //$(document).ready(function (){

        $("#submit-button").click(function (event) {

            submitButton.text('Saving...');
            submitButton.prop("disabled", true);

            // Getting the field values
            var Name = $('#Name').val();
            var category = $('#category').val();
            var lv1 = $('#lv1').val();
            var description = $('#description').val();

            // Creating the data object to send
            var formData = JSON.stringify({
                Name: Name,
                Category: category,
                Lv1: lv1,
                Description: description
            });

            var skillID = <?php echo $skilltree->SkillID; ?>;
            var apiUrl = `/api/v1/skilltree/update/${skillID}`;

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
                        $("#skillname").val(data.updated.SkillName);
                        $("#lv1").val(data.updated.Lv1);
                        $("#category").val(data.updated.Category);
                        $("#description").val(data.updated.Description);

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

        //});
    </script>
@endsection
