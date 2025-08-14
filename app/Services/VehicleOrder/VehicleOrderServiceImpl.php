<?php

namespace App\Services\VehicleOrder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VehicleOrderServiceImpl extends VehicleOrderService {
    public function orderVehicle() {
        $this->setAllAttributes();
        try {
            $this->vehicleOrderProcess();
            return [
                'status' => 'success',
                'message' => 'Successful created order'
            ];
        } catch (\Throwable $th) {

            return [
                'status' => 'failed',
                'message' => $th->getMessage()
            ];
        }
    }
    
    private function setAllAttributes() : void {
        $validatedData = $this->getValidatedData();
        $this->setUserId($validatedData['driver']);
        $this->setVehicleId($validatedData['vehicle']);
        $this->setVehicleCompanyModel($validatedData['vehicle_company']);
        $this->setStartDate($validatedData['start']);
        $this->setEndDate($validatedData['end']);
    }

    private function vehicleOrderProcess() : void {
        DB::beginTransaction();
        try {
            $this->createAndSetVehicleOwner();
            $this->createAndSetVehicleOrder();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Error when transaction vehicle order, {$th->getMessage()}");
            throw $th;
        }
    }
}