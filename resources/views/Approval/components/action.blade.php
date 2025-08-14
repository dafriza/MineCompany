@php
    auth()->user()->is_approvable = (string) $vehicleOrder->status;
    $isApproveable = auth()->user()->is_approvable;
@endphp
@if ($isApproveable)
    <div class="row">
        <div class="col">
            <button class="btn btn-success btnApprove" data-id="{{ $vehicleOrder->id }}">Approve</button>
        </div>
        <div class="col">
            <button class="btn btn-danger btnApprove" data-id="{{ $vehicleOrder->id }}">Rejected</button>
        </div>
    </div>
@else
    {{ $vehicleOrder->status_process_order }}
@endif
