<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadMS extends Model
{
    use HasFactory;
    protected $table = 'lead_management';
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(\App\Models\Business::class);
    }

}
