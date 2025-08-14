@extends('dashboardTemplate.components.dashboard')
@section('slot')
@push('styles')
    <link href="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-2.3.2/af-2.7.0/b-3.2.4/b-colvis-3.2.4/b-print-3.2.4/cr-2.1.1/cc-1.0.7/date-1.5.6/fc-5.0.4/fh-4.0.3/kt-2.12.1/r-3.0.5/rg-1.5.2/rr-1.5.0/sc-2.4.3/sb-1.8.3/sp-2.3.4/sl-3.0.1/sr-1.4.1/datatables.min.css" rel="stylesheet" integrity="sha384-ImhlOjIaENNtKnkTD4Qj6MW80LlOVLCgkd1k020wvqa33qRfrdJnjM7QiEvRNgtP" crossorigin="anonymous">
@endpush
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Simple Tables</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Bordered Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {!! $dataTable->table() !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>

 

@push('scripts')
    <script src="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-2.3.2/af-2.7.0/b-3.2.4/b-colvis-3.2.4/b-print-3.2.4/cr-2.1.1/cc-1.0.7/date-1.5.6/fc-5.0.4/fh-4.0.3/kt-2.12.1/r-3.0.5/rg-1.5.2/rr-1.5.0/sc-2.4.3/sb-1.8.3/sp-2.3.4/sl-3.0.1/sr-1.4.1/datatables.min.js" integrity="sha384-sDAwkYy2io0QkaM3mTCGwkHzjQ0eNhrMpIqVYlbi4kI163ta/EJkX1lhpdxwQN+F" crossorigin="anonymous"></script>
    <script>
        // new DataTable('#rolemanagementtables-table')
    //     new DataTable('#rolemanagementtables-table', {
    //     processing: true,
    //     serverSide: true,
    //     ajax: '{{ route("role_management.index") }}',
    //     columns: [
    //         { data: 'id', name: 'id' },
    //         { data: 'name', name: 'name' }
    //     ]
    // });
        </script>
        {!! $dataTable->scripts() !!}
@endpush
@endsection
