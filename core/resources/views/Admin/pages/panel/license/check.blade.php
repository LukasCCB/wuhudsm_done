@extends('admin.layouts.backend')

@section('title')
    Check panel License
@endsection

@section('content')
    <style>
        .showOver:hover {
            cursor: text;
        }
    </style>

    <!-- Page Content -->
    <div class="content">

        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Check panel License</h3>

                <div class="block-options">
                    <a href="https://discord.gg/rSKtqTcuQr" target="_blank" class="btn btn-sm btn-alt-primary"
                       data-bs-toggle="tooltip"
                       data-bs-animation="true" data-bs-placement="bottom"
                       data-bs-original-title="Join to developer Discord Support">
                        <i class="fab fa-discord"></i> Discord Support
                    </a>
                </div>
            </div>
            <div class="block-content block-content-full">

                <form>
                    <div class="row">
                        <div class="block-content">

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{$lic->message}}</strong>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="IsNew">License registered to</label>
                                        <input type="text" class="form-control" value="{{$lic->license[0]->client}}"
                                               disabled>
                                        <small class="text-warning">Changing the name of the project without first
                                            renewing your license will not work your license.</small>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="IsNew">Registered to Server IP</label>
                                        <input type="text" class="form-control"
                                               value="{{$lic->license[0]->registered_ip}}" disabled>

                                        <small class="text-danger">If you eventually change your host address, you
                                            must first revoke your key and generate a new one.</small>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="IsNew">Package Plan</label>
                                        <input type="text" class="form-control" value="{{$lic->license[0]->package}}"
                                               disabled>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label class="form-label" for="IsNew">Count of Renewals</label>
                                        <input type="text" class="form-control"
                                               value="{{$lic->license[0]->count_renew}}" disabled>
                                        <small class="text-info">Just a record of how many times your license has
                                            been revoked and regenerated.</small>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="IsNew">Re-use attempt</label>
                                        <input type="text" class="form-control"
                                               value="{{$lic->license[0]->re_use_attempt}}" disabled>

                                        <small class="text-info">Number of times attempts to reuse licenses on
                                            unregistered servers.</small>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="IsNew">Expire time left</label>
                                        <input type="text" class="form-control" value="{{$lic->license[0]->expire}}"
                                               disabled>
                                    </div>
                                </div>

                                <div class="mb-12">

                                    <label class="form-label">Your License Key</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control showOver" id="MyLicenseInput"
                                               value="{{$settings->hash_lic_key}}"
                                               disabled>

                                        <button type="button" class="btn btn-alt-info" id="MyLicenseButton"
                                                data-bs-toggle="tooltip"
                                                data-bs-animation="true" data-bs-placement="bottom"
                                                data-bs-original-title="Click to Show or Hidden">
                                            <i class="fa fa-eye" id="MyLicenseIcon"></i>
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

@section("js")
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const MyLicenseInput = document.getElementById("MyLicenseInput");
            const MyLicenseIcon = document.getElementById("MyLicenseIcon");
            const MyLicenseButton = document.getElementById("MyLicenseButton");

            MyLicenseButton.addEventListener("click", function () {
                if (MyLicenseInput.type === "password") {
                    MyLicenseInput.type = "text";
                    MyLicenseIcon.classList.remove("fa-eye");
                    MyLicenseIcon.classList.add("fa-eye-slash");

                } else {
                    MyLicenseInput.type = "password";
                    MyLicenseIcon.classList.remove("fa-eye-slash");
                    MyLicenseIcon.classList.add("fa-eye");
                }
            });
        });
    </script>
@endsection
