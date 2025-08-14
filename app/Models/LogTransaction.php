<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LogTransaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function logable() : MorphTo {
        return $this->morphTo();
    }
}
