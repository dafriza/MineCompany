<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class VehicleUsage extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the vehicleOwner that owns the VehicleUsage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicleOwner(): BelongsTo
    {
        return $this->belongsTo(VehicleOwner::class, 'vehicle_owner_id', 'id');
    }

    public function maintainable() : MorphTo {
        return $this->morphTo();
    }
}
