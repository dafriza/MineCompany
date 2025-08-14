<?php

namespace App\Services\Approval;

use App\Models\User;
use App\Models\VehicleOrder;
use Illuminate\Support\Facades\DB;

class ApprovalServiceImpl extends ApprovalService
{
    public function proposeAction(): array
    {
        $validatedData = $this->getValidatedData();
        $vehicleOrder = $this->getVehicleOrder();
        $statusUpdate = $validatedData['status'];

        DB::beginTransaction();
        try {
            if ($statusUpdate !== 'approve') {
                $this->getVehicleOrder()::withoutEvents(function () use ($validatedData) {
                $this->getVehicleOrder()->update([
                        'status' => $validatedData['statusNumber'],
                    ]);
                });
            } elseif ($statusUpdate === 'approve') {
                $user = auth()->user();
                $user->updated_status_by_approver = $vehicleOrder->status;
                // $vehicleOrder->status = $user->updated_status_by_approver;
                $vehicleOrderModel = $this->getVehicleOrder()->update([
                    'status' => $user->updated_status_by_approver
                ]);
            }

            DB::commit();
            return [
                'title' => 'Success',
                'text' => 'Success Update Data!',
                'icon' => 'success',
            ];
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return [
                'title' => 'Error',
                'text' => $th->getMessage(),
                'icon' => 'error',
            ];
        }
    }

    private function getUser(): User
    {
        $validatedData = $this->getValidatedData();
        $userId = $validatedData['userId'];
        $user = User::query()->find($userId);

        return $user;
    }

    private function getVehicleOrder(): VehicleOrder
    {
        $validatedData = $this->getValidatedData();
        $vehicleOrderId = $validatedData['id'];
        $vehicleOrder = VehicleOrder::query()->find($vehicleOrderId);

        return $vehicleOrder;
    }
}
