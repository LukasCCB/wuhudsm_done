<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Panel - @yield('title') | {{ env("APP_NAME") }} </title>

    <meta name="title" content="Infestation Web Panel">
    <meta name="description"
          content="This panel was developed with the purpose of managing the Infestation/WarZ server in an effective and safe way.">
    <meta name="keywords" content="WarZ Admin Panel, Administration Web Server">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Skullzera">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Stylesheets -->
    <!-- Dashmix framework -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">

    <!-- Modules -->
    @yield("css")

</head>

<body>

<div id="page-container"
     class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow page-header-dark dark-mode">

    <!-- Sidebar -->
    <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="bg-header-dark">
            <div class="content-header bg-white-5">
                <!-- Logo -->
                <a class="fw-semibold text-white tracking-wide" href="/">
            <span class="smini-visible">
              Web<span class="opacity-75">Z</span>
            </span>
                    <span class="smini-hidden">
              {{getenv("APP_NAME")}}<span class="opacity-75"> Panel</span>
            </span>
                </a>
                <!-- END Logo -->

                <!-- Options -->
                <div>

                    <!-- Dark Mode -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                            data-target="#dark-mode-toggler" data-class="far fa"
                            onclick="Dashmix.layout('dark_mode_toggle');">
                        <i class="far fa-moon" id="dark-mode-toggler"></i>
                    </button>
                    <!-- END Dark Mode -->

                </div>
                <!-- END Options -->
            </div>
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">

                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('admin/dashboard') ? ' active' : '' }}"
                           href="{{ route('admin.dashboard') }}">
                            <i class="nav-main-link-icon fa fa-location-arrow"></i>
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-main-heading">Management</li>

                    <li class="nav-main-item{{ request()->is('admin/accounts/*') ? ' open' : '' }}">

                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                           aria-expanded="true" href="">
                            <i class="nav-main-link-icon fa fa-users-gear"></i>
                            <span class="nav-main-link-name">Accounts</span>
                        </a>

                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/accounts/all') ? ' active' : '' }}"
                                   href="{{ route('admin.accounts.all') }}">
                                    <span class="nav-main-link-name">All Accounts</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/accounts/all/premium') ? ' active' : '' }}"
                                   href="{{ route('admin.accounts.all.premium') }}">
                                    <span class="nav-main-link-name">All Premiums</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/accounts/all/developers') ? ' active' : '' }}"
                                   href="{{ route('admin.accounts.all.developers') }}">
                                    <span class="nav-main-link-name">All Developers</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/accounts/all/banneds') ? ' active' : '' }}"
                                   href="{{ route('admin.accounts.all.banneds') }}">
                                    <span class="nav-main-link-name">All Banneds</span>
                                </a>
                            </li>

                        </ul>

                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                           aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-ranking-star"></i>
                            <span class="nav-main-link-name">Top Users</span>

                            <span class="nav-main-link-badge badge rounded-pill bg-warning">LIMITED</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/accounts/top/gc') ? ' active' : '' }}"
                                   href="{{ route('admin.top.users.gc') }}">
                                    <span class="nav-main-link-name">GC</span>
                                    <span class="nav-main-link-badge badge rounded-pill bg-primary">Top 500</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/accounts/top/gd') ? ' active' : '' }}"
                                   href="{{ route('admin.top.users.gd') }}">
                                    <span class="nav-main-link-name">GD</span>
                                    <span class="nav-main-link-badge badge rounded-pill bg-primary">Top 500</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-main-heading">Prices</li>

                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('admin/skilltree/*') ? ' open' : '' }}"
                           href="{{ route('admin.skilltree.list') }}">
                            <i class="nav-main-link-icon fa fa-sitemap"></i>
                            <span class="nav-main-link-name">Skilltree</span>
                        </a>
                    </li>

                    <li class="nav-main-item{{ request()->is('admin/characters/*') ? ' open' : '' }}">
                        <a class="nav-main-link" href="{{ route('admin.characters.list') }}">
                            <i class="nav-main-link-icon fa fa-person"></i>
                            <span class="nav-main-link-name">Characters</span>
                        </a>
                    </li>

                    <li class="nav-main-item{{ request()->is('admin/marketplace/*') ? ' open' : '' }}">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                           aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-store"></i>
                            <span class="nav-main-link-name">Marketplace</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/marketplace/all') ? ' active' : '' }}"
                                   href="{{ route('admin.marketplace.all') }}">
                                    <span class="nav-main-link-name">All Items</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/marketplace/weapons') ? ' active' : '' }}"
                                   href="{{ route('admin.marketplace.weapons') }}">
                                    <span class="nav-main-link-name">Weapons</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/marketplace/ammo') ? ' active' : '' }}"
                                   href="{{ route('admin.marketplace.ammo') }}">
                                    <span class="nav-main-link-name">Ammo</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/marketplace/meeles') ? ' active' : '' }}"
                                   href="{{ route('admin.marketplace.meeles') }}">
                                    <span class="nav-main-link-name">Meeles</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/marketplace/medicals') ? ' active' : '' }}"
                                   href="{{ route('admin.marketplace.medicals') }}">
                                    <span class="nav-main-link-name">Medicals</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/marketplace/eats') ? ' active' : '' }}"
                                   href="{{ route('admin.marketplace.eats') }}">
                                    <span class="nav-main-link-name">Foods & Waters</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/marketplace/gears') ? ' active' : '' }}"
                                   href="{{ route('admin.marketplace.gears') }}">
                                    <span class="nav-main-link-name">Gears</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/marketplace/attachments') ? ' active' : '' }}"
                                   href="{{ route('admin.marketplace.attachments') }}">
                                    <span class="nav-main-link-name">Attachments</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-main-heading">Spawn</li>

                    <li class="nav-main-item{{ request()->is('admin/loot/*') ? ' open' : '' }}">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                           aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-map-location"></i>
                            <span class="nav-main-link-name">Loot Spawn</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/loot/all') ? ' active' : '' }}"
                                   href="{{ route('admin.loot.all') }}">
                                    <span class="nav-main-link-name">All Spawners</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/loot/add') ? ' active' : '' }}"
                                   href="{{ route('admin.loot.add') }}">
                                    <span class="nav-main-link-name">Add new</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-main-heading">Panel Settings</li>

                    <li class="nav-main-item{{ request()->is('admin/panel/settings/*') ? ' open' : '' }}">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                           aria-expanded="false" href="">
                            <i class="nav-main-link-icon fa fa-key"></i>
                            <span class="nav-main-link-name">Panel License</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/panel/license/check') ? ' active' : '' }}"
                                   href="{{ route('admin.panel.license.check') }}">
                                    <span class="nav-main-link-name">Check License</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link"
                                   href="/panel_license?webzow=webzow" target="_blank">
                                    <span class="nav-main-link-name">Conf License</span>
                                    <span class="nav-main-link-badge badge rounded-pill bg-info">Renew</span>
                                </a>
                            </li>

                        </ul>
                    </li>


                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="space-x-1">
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="space-x-1">

                <!-- User Dropdown -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-user d-sm-none"></i>
                        <span class="d-none d-sm-inline-block">Admin</span>
                        <i class="fa fa-fw fa-angle-down opacity-50 ms-1 d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                        <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
                            User Options
                        </div>
                        <div class="p-2">

                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route("logout") }}">
                                <i class="far fa-fw fa-arrow-alt-circle-left me-1"></i> Sign Out
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->

                <!-- Language Dropdown -->
                <button type="button" class="btn btn-alt-secondary" id="page-header-notifications-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-language"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-notifications-dropdown" style="">

                    <ul class="nav-items my-2">
                        <li>
                            <a class="d-flex text-dark py-2" href="?lang=en">
                                <div class="flex-shrink-0 mx-3">
                                    <i class="fa fa-fw fa-square{{ (App::getLocale("locale") === "en") ? "-check text-success" : "" }}"></i>
                                </div>
                                <div class="flex-grow-1 fs-sm pe-2">
                                    <div class="fw-semibold">English (USA)</div>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav-items my-2">
                        <li>
                            <a class="d-flex text-dark py-2" href="?lang=pt-br">
                                <div class="flex-shrink-0 mx-3">
                                    <i class="fa fa-fw fa-square{{ (App::getLocale("locale") === "pt-br") ? "-check text-success" : "" }}"></i>
                                </div>
                                <div class="flex-grow-1 fs-sm pe-2">
                                    <div class="fw-semibold">Português (Brasil)</div>
                                </div>
                            </a>
                        </li>
                    </ul>

                </div>
                <!-- END Language Dropdown -->

                <!-- Developer Discord -->
                <div class="d-inline-block">

                    <a class="btn btn-alt-secondary" href="https://discord.gg/rSKtqTcuQr" target="_blank"
                       data-bs-toggle="tooltip" data-bs-animation="true" data-bs-placement="bottom"
                       data-bs-original-title="Discord Developer">
                        <i class="fab fa-discord"></i>
                    </a>

                    @if($settings->update_available)
                        <a class="btn btn-warning"
                           href="{{$settings->git_last_commit}}" target="_blank"
                           data-bs-toggle="tooltip" data-bs-animation="true" data-bs-placement="bottom"
                           data-bs-original-title="New update available!"
                           id="user_clicked">
                            <i class="fab fa-github text-white"></i>
                            <span class="git_new_update"></span>
                        </a>
                    @endif

                    @if(!$settings->isUpdated)
                        <a class="btn btn-warning"
                           href="/update"
                           data-bs-toggle="tooltip" data-bs-animation="true" data-bs-placement="bottom"
                           data-bs-original-title="New Update for Database">
                            <i class="fa fa-database text-white"></i>
                            <span class="git_new_update"></span>
                        </a>
                    @endif

                </div>
                <!-- END Developer Discord -->

            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-header-dark">
            <div class="bg-white-10">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-sun fa-spin text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        @yield("content")
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
        <div class="content py-0">
            <div class="row fs-sm">
                <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-end">
                    Created <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
                                                                          href="https://webzow.com"
                                                                          target="_blank">Skullzera</a>
                </div>
                <div class="col-sm-6 order-sm-1 text-center text-sm-start">
                    <a class="fw-semibold" href="#" target="_blank">{{getenv("APP_NAME")}}</a> &copy;
                    <span data-toggle="year-copy"></span>{{ $site_version }}
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Page Container -->

@if($settings->update_available)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var githubLink = document.getElementById("user_clicked");

            githubLink.addEventListener("click", function (event) {
                event.preventDefault();

                window.open(githubLink.href, "_blank");

                fetch("/api/v1/github/notify/read", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    }
                })
                    .then(function (response) {
                        githubLink.style.display = "none";
                    })
                    .catch(function (error) {
                        console.error("Failed to send request, contact support."); // error
                    });
            });
        });
    </script>
@endif

<script src="{{ asset("assets/js/dashmix.app.min.js") }}"></script>

<!-- jQuery (required for BS Datepicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider + Password Strength Meter plugins) -->
<script src="{{ asset("assets/js/lib/jquery.min.js") }}"></script>

<!-- Page JS Plugins -->
<script src="{{ asset("assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js") }}"></script>
<script>Dashmix.helpersOnLoad(["jq-notify"]);</script>

@yield("js")

</body>
</html>
