<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTaken extends Model
{
    use HasFactory;
    protected $table = 'paymenttaken';
    protected $guarded = [];
}
