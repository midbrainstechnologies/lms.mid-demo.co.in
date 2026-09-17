<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'status',
        'plan_name',
        'plan_start_date',
        'plan_end_date',
        'price',
        'lead_creator_limit',
        'telecaller_limit'
    ];

    protected $casts = [
    'plan_start_date' => 'date',
    'plan_end_date'   => 'date',
    ];

    protected static function booted()
    {
        static::saving(function ($business) {
            if ($business->plan_end_date >= now()->toDateString()) {
                if ($business->status === 'inactive') {
                    $business->status = 'active';
                }
            }
        });
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function leads()
    {
        return $this->hasMany(Leads::class);
    }
}
