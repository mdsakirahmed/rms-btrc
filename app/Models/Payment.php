<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Payment extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'license_id',
        'payment_method_id',
        'transaction',
        'amount',
        'last_date_of_payment',
        'payment_date',
        'paid',
    ];

    public function license(){
        return $this->belongsTo(License::class, 'license_id', 'id');
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }
}
