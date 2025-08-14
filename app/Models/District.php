<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $primaryKey = 'id';

    protected $guarded = [];

    /**
     * Get the regency that owns the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class, 'regency_id', 'id');
    }

    /**
     * Get all of the villages for the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function villages(): HasMany
    {
        return $this->hasMany(Village::class, 'district_id', 'id');
    }
}
