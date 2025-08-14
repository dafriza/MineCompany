@extends('dashboardTemplate.components.dashboard')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('slot')
    @hasanyrole('administrator|driver')
        <div class="row mb-3">
            <div class="col">
                <button class="btn btn-success createButton">Create</button>
            </div>
        </div>
    @endhasanyrole
    <div class="row">
        <div class="col">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('modal')
    <x-modal-basic id="create" title="Create Order" isFooterUsed="false">
        <form id="createOrderVehicle" action="{{ route('order_vehicle.store') }}" method="post">
            @csrf
            @role('administrator')
                <select id="drivers" class="form-control my-3" name="driver">
                </select>
            @else
                <input type="hidden" name="driver" value="{{ auth()->id() }}">
            @endrole
            <br>
            <select id="vehicles" class="form-control my-3" name="vehicle">
            </select>
            <br>
            <select id="vehicleCompanies" class="form-control my-3" name="vehicle_company">
            </select>
            <br>
            <div class="input-group flex-nowrap">
                <span id="addon-wrapping" class="input-group-text">Start</span>
                <input type="datetime-local" class="form-control" name="start">
            </div>
            <br>
            <div class="input-group flex-nowrap">
                <span id="addon-wrapping" class="input-group-text">End</span>
                <input type="datetime-local" class="form-control" name="end">
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </x-modal-basic>
@endsection
@push('scripts')
    <script
        src="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-2.3.2/af-2.7.0/b-3.2.4/b-colvis-3.2.4/b-print-3.2.4/cr-2.1.1/cc-1.0.7/date-1.5.6/fc-5.0.4/fh-4.0.3/kt-2.12.1/r-3.0.5/rg-1.5.2/rr-1.5.0/sc-2.4.3/sb-1.8.3/sp-2.3.4/sl-3.0.1/sr-1.4.1/datatables.min.js"
        integrity="sha384-sDAwkYy2io0QkaM3mTCGwkHzjQ0eNhrMpIqVYlbi4kI163ta/EJkX1lhpdxwQN+F" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $(function() {
            // const dataTable = new DataTable('#approvaltable-table');

            $(document).on('click', '.createButton', function() {
                $('#createModal').modal('toggle')
            })
            const routeGetDrivers = "{!! route('order_vehicle.select2.drivers') !!}";
            const routeGetVehicles = "{!! route('order_vehicle.select2.vehicles') !!}";
            const routeGetVehicleCompanies = "{!! route('order_vehicle.select2.vehicle_companies') !!}";
            select2Generator('drivers', 'Pilih Driver', 'createModal', routeGetDrivers)
            select2Generator('vehicles', 'Pilih Kendaraan', 'createModal', routeGetVehicles)
            select2Generator('vehicleCompanies', 'Pilih Perusahaan', 'createModal', routeGetVehicleCompanies)

            function select2Generator(id, placeholder, modal, route) {
                // const select2 = $('#drivers').select2({
                const select2 = $('#' + id).select2({
                    placeholder: placeholder + '…',
                    allowClear: true,
                    minimumInputLength: 1,
                    dropdownParent: $('#' + modal),
                    ajax: {
                        // url: "{{ route('order_vehicle.select2.drivers') }}",
                        url: route,
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term || '',
                                page: params.page || 1
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.results,
                                pagination: {
                                    more: data.pagination.more
                                }
                            };
                        },
                        cache: true
                    },
                    theme: "bootstrap-5",
                });
            }

            $(document).on('click', '.btnApprove', function() {
                const routeApproval = "{!! route('approval.store') !!}"
                $.ajax({
                    url: routeApproval,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: $(this).data('id'),
                        userId: "{!! auth()->id() !!}",
                        status: 'approve'
                    },
                    success: function(data) {
                        console.log(data);
                        console.dir(data)
                        Swal.fire(data);
                        // dataTable.ajax.reload();
                    }
                })
            })
        })
    </script>
@endpush
