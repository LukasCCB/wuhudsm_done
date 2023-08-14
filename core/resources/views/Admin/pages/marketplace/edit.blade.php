@extends('admin.layouts.backend')

@section('title')
    Edit Item
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
                <h3 class="block-title">Editing Item</h3>

                <div class="block-options">
                    <a href="/admin/marketplace/all" class="btn btn-sm btn-alt-primary">
                        <i class="far fa-fw fa-circle-left"></i> Back to list
                    </a>
                </div>
            </div>
            <div class="block-content block-content-full">

                <form>
                    <div class="row">
                        <div class="block-content">

                            @include('admin.includes.message')

                            <div id="blockUi">

                                <div class="row">

                                    <div class="col-lg-3">
                                        <img
                                            src="{{ asset('assets/game_img/game_items') }}/updated/{{ $item->FNAME }}.png"
                                            width=90%" alt="Character">
                                    </div>

                                    <div class="col-lg-9">

                                        <div class="mb-4">
                                            <div class="input-group">
                                            <span class="input-group-text">
                                              Name
                                            </span>
                                                <input type="text" class="form-control" id="Name"
                                                       name="Name" value="{{$item->Name}}">
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="input-group">
                                            <span class="input-group-text">
                                             Price
                                            </span>

                                                <input type="number" class="form-control" id="PriceP"
                                                       name="PriceP" value="{{$item->PriceP}}">

                                                <span class="input-group-text">
                                                <img src="{{ asset('assets/media/game/game_points.png') }}"
                                                     alt="GamePoints">
                                            </span>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="input-group">
                                            <span class="input-group-text">
                                             Price
                                            </span>

                                                <input type="number" class="form-control" id="GPriceP"
                                                       name="PriceP" value="{{$item->GPriceP}}">

                                                <span class="input-group-text">
                                                <img src="{{ asset('assets/media/game/game_dollar.png') }}"
                                                     alt="GPriceP">
                                            </span>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label" for="IsNew">Is New <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="IsNew" name="IsNew">
                                                <option value="">--- Please select --</option>
                                                <option value="0" {{ (!$item->IsNew) ? "selected" : "" }} >No</option>
                                                <option value="1" {{ ($item->IsNew) ? "selected" : "" }}>Yes</option>
                                            </select>
                                        </div>

                                        <div class="mb-4">

                                            <label class="form-label" for="IsVisible">Is Visible </label>
                                            <select class="form-select" id="IsVisible" name="IsVisible">
                                                <option value="">--- Please select --</option>
                                                <option value="0" {{ (!$item->IsVisible) ? "selected" : "" }} >No
                                                </option>
                                                <option value="1" {{ ($item->IsVisible) ? "selected" : "" }}>Yes
                                                </option>
                                            </select>

                                            <small class="text-warning">* Attention! If you hidden this item, you can't
                                                more see in this panel!</small>

                                        </div>

                                        <div class="mb-4">

                                            <label class="form-label">Descripton</label>
                                            <div class="input-group">
                                            <textarea class="input-group-text" name="Description" id="Description"
                                                      cols="150" rows="5">{{ $item->Description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <button type="submit" class="btn btn-alt-success me-1 mb-3"
                                                    id="submit-button"
                                                    name="submit-button">
                                                <i class="fa fa-fw fa-check opacity-50 me-1"></i> Save
                                            </button>
                                        </div>

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

        submitButton.click(function (event) {

            submitButton.text('Saving...');
            submitButton.prop("disabled", true);

            // Getting the field values
            var Name = $('#Name').val();
            var Description = $('#Description').val();
            var PriceP = $('#PriceP').val();
            var IsNew = $('#IsNew').val();
            var GPriceP = $('#GPriceP').val();
            var IsVisible = $('#IsVisible').val();

            // Creating the data object to send
            var formData = JSON.stringify({
                Name: Name,
                Description: Description,
                PriceP: PriceP,
                IsNew: IsNew,
                GPriceP: GPriceP,
                IsVisible: IsVisible,
            });

            var skillID = <?php echo $item->ItemID; ?>;
            var apiUrl = `/api/v1/marketplace/update/${skillID}`;

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
                        $("#Name").val(data.updated.Name);
                        $("#Description").val(data.updated.Description);
                        $("#PriceP").val(data.updated.PriceP);
                        $("#IsNew").val(data.updated.IsNew);
                        $("#GPriceP").val(data.updated.GPriceP);
                        $("#IsVisible").val(data.updated.IsVisible);

                        submitButton.text('Saved!');
                        submitButton.prop("disabled", false);

                        setTimeout(function () {
                            $('#error').hide();
                            $('#message').hide();
                            $('#messageSuccess').hide();
                            submitButton.text('Save');
                            submitButton.prop("disabled", false);

                            window.location.reload(true);

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
