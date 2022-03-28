<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartialPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'bank_id',
        'payment_date',
        'paid_amount',
        'vat',
        'late_fee',
        'pay_order_number',
        'journal_number',
    ];


    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
