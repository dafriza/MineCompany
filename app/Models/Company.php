<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user that owns the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function referManagement() : MorphOne {
        return $this->morphOne(ReferenceManagementOffice::class, 'referable');
    }

    public function owner() : MorphOne {
        return $this->morphOne(VehicleOwner::class, 'ownerable');
    }
}
