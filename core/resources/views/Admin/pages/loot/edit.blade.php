@extends('admin.layouts.backend')

@section('title')
    Edit Loot
@endsection

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">

    <!-- Page JS Plugins CSS -->
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
                <h3 class="block-title">Editing Loot</h3>

                <div class="block-options">
                    <a href="/admin/loot/all" class="btn btn-sm btn-alt-primary">
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
                                        <div id="ImageLoad">
                                            <img
                                                src='{{ asset('assets/game_img/game_items/updated/') }}/{{ $result["FNAME"] }}.png'
                                                width="90%" alt="Item Image">
                                        </div>
                                    </div>

                                    <div class="col-lg-9">

                                        <div class="mb-4">
                                            <div class="input-group">
                                            <span class="input-group-text">
                                              Name
                                            </span>
                                                <input type="text" class="form-control" id="Name"
                                                       name="Name" value="{{$result["Name"]}}">
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label" for="Chance">Loot Group Spawn</label>

                                            <select class="js-select2 form-select" id="LootID"
                                                    name="LootID" style="width: 100%;"
                                                    data-placeholder="--- Select one LootID ---">
                                                <option></option>

                                                @foreach($AllLootID as $lootID)
                                                    <option
                                                        value="{{$lootID->ItemID}}" {{ ($result["ItemID"]) ? "selected" : "" }}>{{$lootID->ItemID}}
                                                        - {{$lootID->Name}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label" for="Chance">Item
                                                <span class="text-primary">Unique Choose</span></label>

                                            <select class="js-select2 form-select" id="ItemID"
                                                    name="ItemID" style="width: 100%;"
                                                    data-placeholder="--- Change ItemID ---"
                                                    onchange="UpdateImage(this.options[this.selectedIndex].getAttribute('fname'));">
                                                <option></option>

                                                <option
                                                    value="{{$result["ItemID"]}}" {{ ($result["ItemID"]) ? "selected" : "" }}>{{$result["Name"]}}</option>
                                                @foreach($getAllItems as $item)
                                                    <option value="{{$item->ItemID}}" fname="{{$item->FNAME}}">
                                                        {{$item->ItemID}} - {{$item->Name}}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="mb-4">
                                            <div class="input-group">
                                            <span class="input-group-text">
                                             Price
                                            </span>

                                                <input type="number" class="form-control" id="GDMin"
                                                       name="GDMin" value="{{$result["GDMin"]}}">

                                                <span class="input-group-text">
                                                <img src="{{ asset('assets/media/game/game_dollar.png') }}"
                                                     alt="GameDollar">
                                            </span>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="input-group">
                                            <span class="input-group-text">
                                             Price
                                            </span>

                                                <input type="number" class="form-control" id="GDMax"
                                                       name="GDMax" value="{{$result["GDMax"]}}">

                                                <span class="input-group-text">
                                                <img src="{{ asset('assets/media/game/game_dollar.png') }}"
                                                     alt="GameDollar">
                                            </span>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label" for="Chance">Chance Percent <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="js-rangeslider" id="Chance" name="Chance"
                                                   value="{{$result["Chance"]}}" data-min="0" data-max="100">
                                        </div>

                                        <div class="mb-4">

                                            <label class="form-label" for="IsVisible">Is Visible </label>
                                            <select class="form-select" id="IsVisible" name="IsVisible">
                                                <option value="">--- Please select --</option>
                                                <option value="0" {{ (!$result["IsVisible"]) ? "selected" : "" }} >No
                                                </option>
                                                <option value="1" {{ ($result["IsVisible"]) ? "selected" : "" }}>Yes
                                                </option>
                                            </select>

                                            <small class="text-warning">* Attention! If you hidden this item, you can't
                                                more see in this panel!</small>

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
            var LootID = $('#LootID').val();
            var Chance = $('#Chance').val();
            var ItemID = $('#ItemID').val();
            var GDMin = $('#GDMin').val();
            var GDMax = $('#GDMax').val();
            var Name = $('#Name').val();
            var IsVisible = $('#IsVisible').val();

            // Creating the data object to send
            var formData = JSON.stringify({
                LootID: LootID,
                Chance: Chance,
                ItemID: ItemID,
                GDMin: GDMin,
                GDMax: GDMax,
                Name: Name,
                IsVisible: IsVisible,
            });

            var skillID = <?php echo $result["RecordID"]; ?>;
            var apiUrl = `/api/v1/lootdata/update/${skillID}`;

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
                        /*LootID.val(data.updated.LootID)
                        Chance.val(data.updated.Chance)
                        ItemID.val(data.updated.ItemID)
                        GDMin.val(data.updated.GDMin)
                        GDMax.val(data.updated.GDMax)
                        Name.val(data.updated.Name)
                        IsVisible.val(data.updated.IsVisible)*/

                        submitButton.text('Saved!');
                        submitButton.prop("disabled", false);

                        setTimeout(function () {
                            $('#error').hide();
                            $('#message').hide();
                            $('#messageSuccess').hide();
                            submitButton.text('Save');
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

        function UpdateImage(e) {
            $("#ImageLoad").html("<img src='/assets/game_img/game_items/updated/" + e + ".png' width='90%'>");
        }

        //});
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
