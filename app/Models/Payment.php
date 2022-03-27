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
        'bank_id',
        'payble_amount',
        'last_date_of_payment',
        'payment_date',
        'vat',
        'late_fee',
        'paid',
    ];

    protected $dates = ['last_date_of_payment', 'payment_date'];

    public function expiration(){
        return $this->belongsTo(Expiration::class, 'expiration_id', 'id');
    }

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
