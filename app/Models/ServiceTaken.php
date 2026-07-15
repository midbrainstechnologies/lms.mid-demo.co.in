<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTaken extends Model
{
    use HasFactory;
    protected $table = 'servicetaken';
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(\App\Models\Business::class);
    }

}
