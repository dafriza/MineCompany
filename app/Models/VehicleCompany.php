<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class VehicleCompany extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function owner() : MorphOne {
        return $this->morphOne(VehicleOwner::class, 'ownerable');
    }
}
