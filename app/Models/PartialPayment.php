<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class PartialPayment extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'payment_id',
        'bank_id',
        'payment_date',
        'paid_amount',
        'VAT',
        'late_fee',
        'pay_order_number',
        'journal_number',
    ];

    protected $dates = ['payment_date'];

    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
