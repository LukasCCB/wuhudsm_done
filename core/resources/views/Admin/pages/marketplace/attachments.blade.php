@extends('admin.layouts.backend')

@section('title')
    Listing All Attachments
@endsection

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

    <!-- Page Content -->
    <div class="content">

        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Listing all Attachments</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">ItemD</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price GC</th>
                        <th>Price GD</th>
                        <th>Is New</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($items as $st)
                        <tr>
                            <td class="text-center">{{ $st->ItemID }}</td>
                            <td class="">
                                <img src="{{ asset('assets/game_img/game_items') }}/updated/{{ $st->FNAME }}.png"
                                     width=90px" alt="Item Image">
                            </td>
                            <td class="text-center">{{ $st->Name }}</td>
                            <td class="text-center"><img src="{{ asset('assets/media/game/game_points.png') }}"
                                                         width=15%" alt="GamePoints"> {{ $st->PriceP }}</td>
                            <td class="text-center"><img src="{{ asset('assets/media/game/game_dollar.png') }}"
                                                         width=15%" alt="GameDollar"> {{ $st->GPriceP }}</td>
                            <td class="text-center">{{ $st->IsNew }}</td>
                            <td class="text-center">
                                <a href="/admin/marketplace/edit/{{ $st->ItemID }}" data-bs-toggle="tooltip"
                                   data-bs-animation="true" data-bs-placement="bottom"
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
