<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const ADMINISTRATOR = 'administrator';
    const MANAGER = 'manager';
    const SUPERVISOR = 'supervisor';
    const POOL_MANAGEMENT = 'pool_management';
    const DRIVER = 'driver';

    // status di vehicle order
    const SUPERVISOR_APPROVABLE = '1';
    const MANAGER_APPROVABLE = '2';
    const POOL_MANAGEMENT_APPROVABLE = '3';
    const DRIVER_APPROVABLE = '4';

    /**
     * Get all of the companies for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'user_id', 'id');
    }

    /**
     * Get all of the vehicleOrders for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicleOrders(): HasMany
    {
        return $this->hasMany(VehicleOrder::class, 'user_id', 'id');
    }

    public function maintain(): MorphOne
    {
        return $this->morphOne(VehicleUsage::class, 'maintainable');
    }

    public function scopeTermFilter(Builder $user, string $term): void
    {
        $user->when($term !== '', function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%");
        });
    }

    public function roleName(): Attribute
    {
        return Attribute::make(get: fn($value) => ($approvalRole = $this->getRoleNames()[0]));
    }

    public function isApprovalRole(): Attribute
    {
        return Attribute::make(
            get: function () {
                $approvalRole = $this->role_name;
                if ($approvalRole === self::MANAGER || $approvalRole === self::SUPERVISOR || $approvalRole === self::POOL_MANAGEMENT) {
                    return true;
                }

                return false;
            },
        );
    }

    public function isApprovable(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                switch ($this->role_name) {
                    case self::MANAGER:
                        if ($value === self::MANAGER_APPROVABLE) {
                            return true;
                        }
                        return false;
                        break;

                    case self::SUPERVISOR:
                        if ($value === self::SUPERVISOR_APPROVABLE) {
                            return true;
                        }
                        return false;
                        break;

                    case self::POOL_MANAGEMENT:
                        if ($value === self::POOL_MANAGEMENT_APPROVABLE) {
                            return true;
                        }
                        return false;
                        break;

                    case self::DRIVER:
                        if ($value === self::DRIVER_APPROVABLE) {
                            return true;
                        }
                        return false;
                        break;

                    default:
                        return false;
                        break;
                }
            },
            set: fn(string $value) => $value,
        );
    }

    public function updatedStatusByApprover(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                switch ($this->role_name) {
                    case self::MANAGER:
                        if ($value === self::MANAGER_APPROVABLE) {
                            return 3;
                        }
                        return 8;
                        break;

                    case self::SUPERVISOR:
                        if ($value === self::SUPERVISOR_APPROVABLE) {
                            return 2;
                        }
                        return 8;
                        break;

                    case self::POOL_MANAGEMENT:
                        if ($value === self::POOL_MANAGEMENT_APPROVABLE) {
                            return 4;
                        }
                        return 8;
                        break;

                    case self::DRIVER:
                        if ($value === self::DRIVER_APPROVABLE) {
                            return 5;
                        }
                        return 8;
                        break;

                    default:
                        return 8;
                        break;
                }
            },
            set: fn(string $value) => $value,
        );
    }
}
