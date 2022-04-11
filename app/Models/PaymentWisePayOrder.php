<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class PaymentWisePayOrder extends Model
{
    use HasFactory, Userstamps;
    
    protected $fillable = [
        'payment_id',
        'bank_id',
        'amount',
        'number',
        'date'
    ];

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
