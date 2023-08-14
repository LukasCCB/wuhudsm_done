@extends('admin.layouts.backend')

@section('title')
    Dashboard
@endsection

@section('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/chart.js/chart.umd.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/pages/be_pages_ecom_dashboard.min.js') }}"></script>
@endsection

@section('content')

    <div class="bg-image" style="background-image: url('/assets/media/various/bg_dashboard.jpg');">
        <div class="bg-black-75">
            <div class="content content-full">
                <div class="row my-3">
                    <div class="col-md-5 d-md-flex align-items-md-center">
                        <div class="py-4 py-md-0 text-center text-md-start">
                            <h1 class="fs-2 text-white mb-2">Dashboard</h1>
                            <h2 class="fs-lg fw-normal text-white-75 mb-0">{{ trans('dashboard.welcome') }}</h2>
                        </div>
                    </div>
                    <div class="col-md-7 d-md-flex align-items-md-center">
                        <div class="row w-100 text-center">
                            <div class="col-6 col-xl-4 offset-xl-4">
                                <p class="fs-3 fw-semibold text-white mb-0">
                                    0
                                </p>
                                <p class="fs-sm fw-semibold text-white-75 text-uppercase mb-0">
                                    <i class="fa fa-money-bill-trend-up opacity-75 me-1"></i> {{ trans('dashboard.last_24h_donates') }}
                                </p>
                            </div>
                            <div class="col-6 col-xl-4">
                                <p class="fs-3 fw-semibold text-white mb-0">
                                    $ 0
                                </p>
                                <p class="fs-sm fw-semibold text-white-75 text-uppercase mb-0">
                                    <i class="fa fa-users-line opacity-75 me-1"></i> {{ trans('dashboard.last_24h_donates_value') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="content">
        <!-- Quick Overview -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="d-flex align-items-center justify-content-between p-1">

                            <div class="me-3">
                                <p class="text-muted mb-0">
                                    Users Last 24h
                                </p>
                                <p class="fs-3 mb-0">
                                    {{$Latest24_NewUsers}}
                                </p>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="d-flex align-items-center justify-content-between p-1">
                            <div class="me-3">
                                <p class="text-muted mb-0">
                                    Users Last 30 days
                                </p>
                                <p class="fs-3 mb-0">
                                    {{$Latest30d_NewUsers}}
                                </p>
                            </div>
                            <div>
                                <!-- Sparkline Dashboard Projects Container -->
                                <span class="js-sparkline js-sparkline-enabled" data-type="line"
                                      data-points="[17,19,15,12,13,14,18,19]" data-width="90px" data-height="40px"
                                      data-line-color="#3c90df" data-fill-color="transparent"
                                      data-spot-color="transparent" data-min-spot-color="transparent"
                                      data-max-spot-color="transparent" data-highlight-spot-color="#3c90df"
                                      data-highlight-line-color="#3c90df" data-tooltip-suffix="Projects"><canvas
                                        width="90" height="40"
                                        style="display: inline-block; width: 90px; height: 40px; vertical-align: top;"></canvas></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-xl-3">
                <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="d-flex align-items-center justify-content-between p-1">
                            <div class="me-3">
                                <p class="text-muted mb-0">
                                    Premium Last 24h
                                </p>
                                <p class="fs-3 mb-0">
                                    {{$Latest24h_NewPremium}}
                                </p>
                            </div>
                            <div>
                                <!-- Sparkline Dashboard Tickets Container -->
                                <span class="js-sparkline js-sparkline-enabled" data-type="line"
                                      data-points="[21,17,19,35,34,25,18,32]" data-width="90px" data-height="40px"
                                      data-line-color="#e04f1a" data-fill-color="transparent"
                                      data-spot-color="transparent" data-min-spot-color="transparent"
                                      data-max-spot-color="transparent" data-highlight-spot-color="#e04f1a"
                                      data-highlight-line-color="#e04f1a" data-tooltip-suffix="Tickets"><canvas
                                        width="90" height="40"
                                        style="display: inline-block; width: 90px; height: 40px; vertical-align: top;"></canvas></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="d-flex align-items-center justify-content-between p-1">
                            <div class="me-3">
                                <p class="text-muted mb-0">
                                    Banneds Last 24h
                                </p>
                                <p class="fs-3 mb-0">
                                    {{$Latest24h_Banneds}}
                                </p>
                            </div>
                            <div>
                                <!-- Sparkline Dashboard Sales Container -->
                                <span class="js-sparkline js-sparkline-enabled" data-type="line"
                                      data-points="[268,225,236,262,259,280,232,256]" data-width="90px"
                                      data-height="40px" data-line-color="#343a40" data-fill-color="transparent"
                                      data-spot-color="transparent" data-min-spot-color="transparent"
                                      data-max-spot-color="transparent" data-highlight-spot-color="#343a40"
                                      data-highlight-line-color="#343a40" data-tooltip-suffix="Sales"><canvas width="90"
                                                                                                              height="40"
                                                                                                              style="display: inline-block; width: 90px; height: 40px; vertical-align: top;"></canvas></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Quick Overview -->

        <!-- Latest -->
        <div class="row">
            <!-- Top 10 user more active -->
            <div class="col-xl-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">{{ trans('dashboard.top10_users_most_active') }}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter fs-sm">
                            <tbody>

                            @foreach($AllTime_UsersMostActive as $user)
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="">{{$user->CustomerID}}</a>
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td class="d-none d-sm-table-cell text-end text-nowrap">
                                        <div class="text-info">
                                            <i class="far fa-clock opacity-75 me-1"></i> {{$user->TimePlayed}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top 10 latest registered -->
            <div class="col-xl-4">
                <!-- Latest Orders -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Latest 10 Registers</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table
                            class="table table-borderless table-striped table-vcenter fs-sm table-striped table-vcenter js-dataTable-buttons">

                            <tbody>

                            @foreach($Latest24_NewUsers_10 as $user)
                                <tr>
                                    <td class="fw-semibold text-center" style="width: 100px;">
                                        <a href="/admin/accounts/show/{{$user->CustomerID}}">{{$user->CustomerID}}</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <a href="/admin/accounts/show/{{$user->CustomerID}}">{{$user->email}}</a>
                                    </td>
                                    <td>

                                    </td>
                                    <td class="fw-semibold text-end  text-center">
                                        <a href="/admin/accounts/show/{{$user->CustomerID}}" target="_blank"
                                           data-bs-toggle="tooltip" data-bs-animation="true" data-bs-placement="bottom"
                                           data-bs-original-title="View user">
                                            <i class="far fa-eye opacity-75 me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Latest Orders -->
            </div>

            <!-- Top 10 latest donates -->
            <div class="col-xl-4">
                <!-- Latest Orders -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Latest 10 Donates</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter fs-sm">
                            <tbody>

                            <tr>
                                <td class="fw-semibold text-center" style="width: 100px;">
                                    <a href="">--- No results found ---</a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Latest Orders -->
            </div>
        </div>
        <!-- END Latest -->
    </div>
    <!-- END Page Content -->

@endsection
