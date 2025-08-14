<?php

namespace App\Services\Approval;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleCompany;
use App\Models\VehicleOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApprovalService {
    private array $validatedData;
    private User $userModel;
    private VehicleOrder $vehicleOrderModel;

    public function setValidatedData(array $validatedData) : void {
        $this->validatedData = $validatedData;
    }

    public function getValidatedData() : array {
        return $this->validatedData;
    }

    protected function setUserModel(User $userModel) : void {
        $this->userModel = $userModel;
    }

    protected function getUserModel() : User {
        return $this->userModel;
    }

    protected function setVehicleOrderModel(VehicleOrder $vehicleOrderModel) : void {
        $this->vehicleOrderModel = $vehicleOrderModel;
    }

    protected function getVehicleOrderModel() : VehicleOrder {
        return $this->vehicleOrderModel;
    }
}