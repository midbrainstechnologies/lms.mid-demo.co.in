<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;
    protected $table = 'lead_status';
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(\App\Models\Business::class);
    }

}
