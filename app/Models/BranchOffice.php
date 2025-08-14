<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchOffice extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the mainOffice that owns the BranchOffice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mainOffice(): BelongsTo
    {
        return $this->belongsTo(MainOffice::class, 'main_office_id', 'id');
    }

    /**
     * Get the manager that owns the BranchOffice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
