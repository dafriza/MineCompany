<?php

namespace App\Models\Traits\VehicleOrder;

use App\Models\LogTransaction;
use Illuminate\Support\Facades\Log;

trait CreatingOrder
{
    public static function bootCreatingOrder()
    {
        static::creating(function ($model) {
            // Event sebelum model disimpan
            $model->order_id = fake()->lexify('id-????');
            if (empty($model->status)) {
                $model->status = 1;
            }
            Log::info('Creating model: ' . get_class($model));
        });

        static::created(function ($model) {
            $logTransaction = new LogTransaction([
                'descriptions' => get_class($model) . ' has created, id : ' . $model->id . ', status => ' . $model->status,
            ]);

            $model->logTransaction()->save($logTransaction);
            Log::info('Created model: ' . get_class($model));
        });

        static::updating(function ($model) {
            Log::info('Updating model: ' . get_class($model));
        });

        static::updated(function ($model) {
            $logTransaction = new LogTransaction([
                'descriptions' => get_class($model) . ' has updated, id : ' . $model->id . ', status => ' . $model->status,
            ]);

            $model->logTransaction()->save($logTransaction);
            Log::info('Updated model: ' . get_class($model));
        });
        
        static::saving(function ($model) {
            Log::info('Saving model: ' . get_class($model));
        });

        static::saved(function ($model) {
            $logTransaction = new LogTransaction([
                'descriptions' => get_class($model) . ' has updated, id : ' . $model->id . ', status => ' . $model->status,
            ]);

            $model->logTransaction()->save($logTransaction);
            Log::info('Saved model: ' . get_class($model));
        });
    }
}
