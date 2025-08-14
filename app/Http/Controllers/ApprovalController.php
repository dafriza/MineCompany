<?php

namespace App\Http\Controllers;

use App\DataTables\Approval\ApprovalTableDataTable;
use App\DataTables\OrderVehicle\OrderVehicleDataTable;
use App\Http\Requests\ApprovalRequest;
use App\Http\Requests\OrderVehicleRequest;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleCompany;
use App\Services\Approval\ApprovalServiceImpl;
use App\Traits\Select2Trait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    use Select2Trait;
    private ApprovalServiceImpl $approvalServiceImpl;
    public function __construct(ApprovalServiceImpl $approvalServiceImpl)
    {
        $this->approvalServiceImpl = $approvalServiceImpl;
    }

    public function index(OrderVehicleDataTable $dataTable)
    {
        return $dataTable->render('Approval.index');
    }

    public function store(ApprovalRequest $request) : array {
        $validatedData = $request->validated();
        $this->approvalServiceImpl->setValidatedData($validatedData);
        $response = $this->approvalServiceImpl->proposeAction();

        return $response;
    }
}
