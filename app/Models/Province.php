<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    protected $primaryKey = 'id';

    protected $guarded = [];

    /**
     * Get all of the regencies for the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regencies(): HasMany
    {
        return $this->hasMany(Regency::class, 'province_id', 'id');
    }
}
