@extends('admin.layouts.backend')

@section('title') Listing All Skilltree @endsection

@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('js')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">List all Skilltree</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Skilltree</li>
                        <li class="breadcrumb-item active" aria-current="page">All Skilltree</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Listing all Skilltree</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">SkillID</th>
                        <th style="width: 10%;">Price GC</th>
                        <th style="width: 13%;">Category</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 35%;">Description</th>
                        <th style="width: 3%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($skilltree as $st)
                        <tr>
                            <td class="text-center">{{ $st->SkillName }}</td>
                            <td class="d-none d-sm-table-cell"><img src="{{ asset('assets/media/game/game_points.png') }}" width=15%" alt="GamePoints"> {{ $st->Lv1 }}</td>
                            <td class="fw-semibold">{{ $st->Category }}</td>
                            <td class="fw-semibold">{{ $st->Name }}</td>
                            <td class="fw-semibold">{{ $st->Description }}</td>
                            <td class="fw-semibold">
                                <a href="/admin/skilltree/edit/{{ $st->SkillID }}" data-bs-toggle="tooltip" data-bs-animation="true" data-bs-placement="bottom"
                                   data-bs-original-title="Edit {{ $st->Name }}">
                                    <i class="fa fa-pencil opacity-75 me-1"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
