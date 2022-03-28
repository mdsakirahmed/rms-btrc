<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Payment extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'expiration_id',
        'payble_amount',
        'last_date_of_payment',
    ];

    protected $dates = ['last_date_of_payment'];

    public function expiration(){
        return $this->belongsTo(Expiration::class, 'expiration_id', 'id');
    }

    public function partial_payments(){
        return $this->hasMany(PartialPayment::class, 'payment_id', 'id');
    }

    public function paid(){
        return $this->partial_payments->sum('paid_amount');
    }

    public function due(){
        return ($this->payble_amount - $this->paid());
    }
}
