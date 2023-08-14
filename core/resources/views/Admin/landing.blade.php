@extends('admin.layouts.simple')

@section('content')

    <style>
        .flag {
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            line-height: 1;
            text-rendering: auto;
        }

        .flag-fw {
            text-align: center;
            width: 1.25em;
        }
    </style>

    <!-- Hero -->
    <div class="hero bg-body-extra-light">
        <div class="hero-inner">

            <div class="content content-full text-center">
                <h1 class="fw-bold mb-2">
                    <span class="text-primary">{{getenv("APP_NAME")}}</span> {{ trans("landing.admin_panel") }}
                </h1>

                <h2 class="h4 fw-medium text-muted mb-5">
                    {!! trans("landing.message") !!}
                </h2>

                @if($settings->isInstalled == 0)
                    <a class="btn btn-hero btn-primary px-4 py-3 d-inline-block" href="/install?lang=en">
                        <i class="fa fa-fw fa-hard-drive opacity-50 me-1"></i> {{ trans("messages.install_panel") }}
                    </a>
                @endif

                @if($settings->isUpdated == 0)
                    <a class="btn btn-hero btn-warning px-4 py-3 d-inline-block" href="/update?lang=en">
                        <i class="fa fa-fw fa-user-clock opacity-50 me-1"></i> {{ trans("messages.install_update") }}
                    </a>
                @endif

                <a class="btn btn-hero btn-primary px-4 py-3 d-inline-block" href="{{ route('admin') }}">
                    <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> {{ trans("landing.enter_dashboard") }}
                </a>

                <hr>

                <a class="btn btn-hero btn-dark px-4 py-1 d-inline-block" href="?lang=en">
                    <img src="https://i.imgur.com/zz2G6lT.png" class="flag flag-fw opacity-50 m-1" alt=""> English
                </a>

                <a class="btn btn-hero btn-dark px-4 py-1 d-inline-block" href="?lang=pt-br">
                    <img src="https://i.imgur.com/3Wk28iE.png" class="flag flag-fw opacity-50 m-1" alt=""> Português
                </a>

            </div>


        </div>
    </div>
    <!-- END Hero -->
@endsection
