<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MainOffice extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the company that owns the MainOffice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * Get the poolManagement that owns the MainOffice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poolManagement(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    /**
     * Get the administrator that owns the MainOffice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function administrator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function referManagement() : MorphOne {
        return $this->morphOne(ReferenceManagementOffice::class, 'referable');
    }
}
