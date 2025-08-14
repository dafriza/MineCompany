<?php

namespace App\Services\VehicleOrder;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleCompany;
use App\Models\VehicleOrder;
use App\Models\VehicleOwner;
use Carbon\Carbon;

class VehicleOrderService {
    private User $userModel;
    private Vehicle $vehicleModel;
    private VehicleCompany $vehicleCompanyModel;
    private VehicleOwner $vehicleOwner;
    private VehicleOrder $vehicleOrder;
    
    
    private array $validatedData;
    private string $startDate;
    private string $endDate;
    private string | int $userId;
    private string | int $vehicleId;

    public function setValidatedData(array $validatedData) : void {
        $this->validatedData = $validatedData;
    }

    public function getValidatedData() : array {
        return $this->validatedData;
    }

    protected function setUserId(string | int $userId) : void {
        $this->userId = $userId;
    }

    protected function getUserId() : string | int {
        return $this->userId;
    }

    protected function setVehicleId(string | int $vehicleId) : void {
        $this->vehicleId = $vehicleId;
    }

    protected function getVehicleId() : string | int {
        return $this->vehicleId;
    }

    protected function setUserModel(string | int $userId) : void {
        $user = User::find($userId);
        $this->userModel = $user;
    }

    protected function getUserModel() : User {
        return $this->userModel;
    }

    protected function setVehicleModel(string | int $vehicleId) : void {
        $vehicle = Vehicle::find($vehicleId);
        $this->vehicleModel = $vehicle;
    }

    protected function getVehicleModel() : Vehicle {
        return $this->vehicleModel;
    }

    protected function setVehicleCompanyModel(string | int $vehicleCompanyId) : void {
        $vehicleCompany = VehicleCompany::find($vehicleCompanyId);
        $this->vehicleCompanyModel = $vehicleCompany;
    }

    protected function getVehicleCompanyModel() : VehicleCompany {
        return $this->vehicleCompanyModel;
    }

    protected function setVehicleOwnerModel(VehicleOwner $vehicleOwner) : void {
        $this->vehicleOwner = $vehicleOwner;
    }

    protected function getVehicleOwner() : VehicleOwner {
        return $this->vehicleOwner;
    }
    
    protected function setVehicleOrderModel(VehicleOrder $vehicleOrderModel) : void {
        $this->vehicleOrder = $vehicleOrderModel;
    }

    protected function getVehicleOrder() : VehicleOrder {
        return $this->vehicleOrder;
    }

    protected function setStartDate(string $startDate) : void {
        $this->startDate = $startDate;
    }

    protected function getStartDate() : Carbon {
        $date = Carbon::parse($this->startDate);
        return $date;
    }

    protected function setEndDate(string $endDate) : void {
        $this->endDate = $endDate;
    }

    protected function getEndDate() : Carbon {
        $date = Carbon::parse($this->endDate);
        return $date;
    }

    protected function createAndSetVehicleOwner() : void {
        $userId = $this->getUserId();
        $vehicleId = $this->getVehicleId();
        $vehicleOwner = new VehicleOwner([
            'user_id' => $userId,
            'vehicle_id' => $vehicleId
        ]);

        $vehicleOwner = $this->getVehicleCompanyModel()->owner()->save($vehicleOwner);
        $this->setVehicleOwnerModel($vehicleOwner);
    }

    protected function createAndSetVehicleOrder() : void {
        $vehicleOwner = $this->getVehicleOwner();
        $vehicleOrderAttributes = new VehicleOrder([
            'start' => $this->getStartDate()->format('Y-m-d H:i:s'),
            'end' => $this->getEndDate()->format('Y-m-d H:i:s'),
        ]);

        $vehicleOrderModel = $vehicleOwner->vehicleOrder()->save($vehicleOrderAttributes);
        $this->setVehicleOrderModel($vehicleOrderModel);
    }
}