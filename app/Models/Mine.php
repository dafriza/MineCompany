<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mine extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the province that owns the Mine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    /**
     * Get the regency that owns the Mine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class, 'regency_id', 'id');
    }

    /**
     * Get the district that owns the Mine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    /**
     * Get the village that owns the Mine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }

    /**
     * Get the supervisor that owns the Mine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the branchOffice that owns the Mine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branchOffice(): BelongsTo
    {
        return $this->belongsTo(BranchOffice::class, 'branch_office_id', 'id');
    }
}
