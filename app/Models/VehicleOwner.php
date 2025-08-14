<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class VehicleOwner extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ownerable() : MorphTo {
        return $this->morphTo();
    }

    /**
     * Get the driver that owns the VehicleOwner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the vehicle that owns the VehicleOwner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    /**
     * Get all of the vehicleOrder for the VehicleOwner
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicleOrder(): HasMany
    {
        return $this->hasMany(VehicleOrder::class, 'vehicle_owner_id', 'id');
    }
}
