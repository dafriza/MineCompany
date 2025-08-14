<?php

namespace App\Models;

use App\Models\Traits\VehicleOrder\CreateOrder;
use App\Models\Traits\VehicleOrder\CreatingOrder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class VehicleOrder extends Model
{
    use HasFactory, CreatingOrder;

    protected $guarded = ['updated_at'];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    protected $appends = ['start_formatted', 'end_formatted'];

    const STATUS = [
        1 => 'Propose',
        2 => 'Approve Supervisor',
        3 => 'Approve Manager',
        4 => 'Approve Pool Management',
        5 => 'Approved',
        6 => 'Borrowed',
        7 => 'Done',
        8 => 'Rejected',
    ];

    const STATUS_PROCESS = [
        1 => 'Waiting for supervisor',
        2 => 'Waiting for manager',
        3 => 'Waiting for pool management',
        4 => 'Waiting your approvement (Driver)',
        5 => 'Ready to borrow',
        6 => 'Is being borrowed',
        7 => 'Completed',
        8 => 'Rejected',
    ];

    /**
     * Get the vehicleOwner that owns the VehicleOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicleOwner(): BelongsTo
    {
        return $this->belongsTo(VehicleOwner::class, 'vehicle_owner_id', 'id');
    }

    public function maintain(): MorphMany
    {
        return $this->MorphMany(VehicleUsage::class, 'maintainable');
    }

    public function logTransaction(): MorphMany
    {
        return $this->morphMany(LogTransaction::class, 'logable');
    }

    public function driver(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->vehicleOwner->driver;
            },
        );
    }

    public function statusOrder(): Attribute
    {
        return Attribute::make(get: fn($value) => self::STATUS[$this->status]);
    }

    public function statusProcessOrder(): Attribute
    {
        return Attribute::make(get: fn($value) => self::STATUS_PROCESS[$this->status]);
    }

    public function startFormatted(): Attribute
    {
        return Attribute::make(get: fn($value) => $this->start->translatedFormat('l, d F Y H:i'));
    }

    public function endFormatted(): Attribute
    {
        return Attribute::make(get: fn($value) => $this->end->translatedFormat('l, d F Y H:i'));
    }
}
